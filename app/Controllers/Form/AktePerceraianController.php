<?php
namespace App\Controllers\Form;

use App\Controllers\BaseController;
use App\Models\AktePerceraianModel;

class AktePerceraianController extends BaseController
{
    protected $perceraianModel;

    public function __construct()
    {
        $this->perceraianModel = new AktePerceraianModel();
    }

    public function index()
    {
        $data = [
            'title' => 'Form Pengajuan Akte Perceraian',
            'user'  => session()->get('user')
        ];
        return view('home/Form/Akteperceraian/AktePerceraian', $data);
    }

    public function prosesAkteAjax()
    {
        $validation = \Config\Services::validation();
        $rules = [
            'nama_suami'           => 'required|min_length[3]',
            'nik_suami'            => 'required|numeric|exact_length[16]',
            'nama_istri'           => 'required',
            'nik_istri'            => 'required|numeric|exact_length[16]',
            'nomor_perkawinan'     => 'required',
            'tanggal_perkawinan'   => 'required',
            'tempat_perkawinan'    => 'required',
            'tanggal_perceraian'   => 'required',
            'tempat_perceraian'    => 'required',
            'penyebab_perceraian'  => 'required',
        ];
        if (!$this->validate($rules)) {
            return $this->response->setJSON([
                'status' => 'error',
                'message' => 'Validasi gagal',
                'errors' => $validation->getErrors()
            ]);
        }

        // Upload file
        $path = WRITEPATH . 'uploads/akteperceraian/';
        if (!is_dir($path)) mkdir($path, 0777, true);
        $dataFile = [];
        foreach (['file_ktp_suami','file_ktp_istri','file_akte_perkawinan','file_putusan_pengadilan','file_kk'] as $fileField) {
            $file = $this->request->getFile($fileField);
            if ($file && $file->isValid()) {
                $newName = $fileField . '-' . time() . '.' . $file->getExtension();
                $file->move($path, $newName);
                $dataFile[$fileField] = 'uploads/akteperceraian/' . $newName;
            }
        }

        $user = session('user');
        $data = [
            'user_id'               => $user['id'] ?? null,
            'nama_suami'            => $this->request->getPost('nama_suami'),
            'nik_suami'             => $this->request->getPost('nik_suami'),
            'nama_istri'            => $this->request->getPost('nama_istri'),
            'nik_istri'             => $this->request->getPost('nik_istri'),
            'nomor_perkawinan'      => $this->request->getPost('nomor_perkawinan'),
            'tanggal_perkawinan'    => $this->request->getPost('tanggal_perkawinan'),
            'tempat_perkawinan'     => $this->request->getPost('tempat_perkawinan'),
            'tanggal_perceraian'    => $this->request->getPost('tanggal_perceraian'),
            'tempat_perceraian'     => $this->request->getPost('tempat_perceraian'),
            'penyebab_perceraian'   => $this->request->getPost('penyebab_perceraian'),
            'file_ktp_suami'        => $dataFile['file_ktp_suami'] ?? null,
            'file_ktp_istri'        => $dataFile['file_ktp_istri'] ?? null,
            'file_akte_perkawinan'  => $dataFile['file_akte_perkawinan'] ?? null,
            'file_putusan_pengadilan'=> $dataFile['file_putusan_pengadilan'] ?? null,
            'file_kk'               => $dataFile['file_kk'] ?? null,
            'status_pengajuan'      => 'Selesai'
        ];

        $insert = $this->perceraianModel->insert($data);
        $lastId = $this->perceraianModel->getInsertID();

        if ($insert) {
            // Generate PDF
            $pengajuan = $this->perceraianModel->find($lastId);
            $pdfData = [
                'nomor_akte'            => 'AKTE-CERAI-' . str_pad($lastId, 6, '0', STR_PAD_LEFT),
                'nama_suami'            => $pengajuan['nama_suami'],
                'nik_suami'             => $pengajuan['nik_suami'],
                'nama_istri'            => $pengajuan['nama_istri'],
                'nik_istri'             => $pengajuan['nik_istri'],
                'nomor_perkawinan'      => $pengajuan['nomor_perkawinan'],
                'tanggal_perkawinan'    => $pengajuan['tanggal_perkawinan'],
                'tempat_perkawinan'     => $pengajuan['tempat_perkawinan'],
                'tanggal_perceraian'    => $pengajuan['tanggal_perceraian'],
                'tempat_perceraian'     => $pengajuan['tempat_perceraian'],
                'penyebab_perceraian'   => $pengajuan['penyebab_perceraian'],
                'tanggal_pencatatan'    => date('Y-m-d'),
            ];
            $html = view('pdf/aktePerceraian_pdf', $pdfData);

            $dompdf = new \Dompdf\Dompdf();
            $dompdf->loadHtml($html);
            $dompdf->setPaper('A4', 'portrait');
            $dompdf->render();

            $pdfName = 'akte-perceraian-' . $lastId . '-' . time() . '.pdf';
            file_put_contents($path . $pdfName, $dompdf->output());

            $this->perceraianModel->update($lastId, [
                'file_pdf' => 'uploads/akteperceraian/' . $pdfName
            ]);

            return $this->response->setJSON([
                'status' => 'success',
                'message' => "Pengajuan berhasil disimpan! Akte Perceraian digital bisa diunduh dari riwayat.",
                'id' => $lastId
            ]);
        } else {
            return $this->response->setJSON([
                'status' => 'error',
                'message' => 'Gagal simpan data. Coba ulangi!'
            ]);
        }
    }

    public function riwayat()
    {
        $userId = session('user.id');
        $riwayat = $this->perceraianModel
            ->where('user_id', $userId)
            ->orderBy('id', 'DESC')
            ->findAll();

        return view('home/Form/AktePerceraian/riwayat', [
            'title'   => 'Riwayat Pengajuan Akte Perceraian',
            'riwayat' => $riwayat
        ]);
    }

    public function downloadAkte($id)
    {
        $pengajuan = $this->perceraianModel->find($id);

        if (!$pengajuan || $pengajuan['user_id'] != session('user.id')) {
            return redirect()->to('/')->with('error', 'Akses ditolak');
        }

        $pdfPath = WRITEPATH . $pengajuan['file_pdf'];
        if (!file_exists($pdfPath)) {
            return redirect()->back()->with('error', 'File tidak ditemukan');
        }

        return $this->response
            ->setHeader('Content-Type', 'application/pdf')
            ->setHeader('Content-Disposition', 'attachment; filename="Akte-Perceraian-'.$pengajuan['id'].'.pdf"')
            ->setBody(file_get_contents($pdfPath));
    }
}
