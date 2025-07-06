<?php
namespace App\Controllers\Form;

use App\Controllers\BaseController;
use App\Models\AktePerkawinanModel;

class AktePerkawinanController extends BaseController
{
    protected $perkawinanModel;

    public function __construct()
    {
        $this->perkawinanModel = new AktePerkawinanModel();
    }

    public function index()
    {
        $data = [
            'title' => 'Form Pengajuan Akte Perkawinan',
            'user'  => session()->get('user')
        ];
        return view('home/Form/Akteperkawinan/AktePerkawinan', $data);
    }

    public function prosesAkteAjax()
    {
        $validation = \Config\Services::validation();
        $rules = [
            'nama_suami'           => 'required|min_length[3]',
            'nik_suami'            => 'required|numeric|exact_length[16]',
            'tempat_lahir_suami'   => 'required',
            'tanggal_lahir_suami'  => 'required',
            'agama_suami'          => 'required',
            'alamat_suami'         => 'required',
            'nama_istri'           => 'required|min_length[3]',
            'nik_istri'            => 'required|numeric|exact_length[16]',
            'tempat_lahir_istri'   => 'required',
            'tanggal_lahir_istri'  => 'required',
            'agama_istri'          => 'required',
            'alamat_istri'         => 'required',
            'tanggal_perkawinan'   => 'required',
            'tempat_perkawinan'    => 'required',
        ];
        if (!$this->validate($rules)) {
            return $this->response->setJSON([
                'status' => 'error',
                'message' => 'Validasi gagal',
                'errors' => $validation->getErrors()
            ]);
        }

        // Upload file
        $path = WRITEPATH . 'uploads/akteperkawinan/';
        if (!is_dir($path)) mkdir($path, 0777, true);
        $dataFile = [];
        foreach (['file_ktp_suami','file_ktp_istri','file_kk','file_buku_nikah','file_surat_perkawinan'] as $fileField) {
            $file = $this->request->getFile($fileField);
            if ($file && $file->isValid()) {
                $newName = $fileField . '-' . time() . '.' . $file->getExtension();
                $file->move($path, $newName);
                $dataFile[$fileField] = 'uploads/akteperkawinan/' . $newName;
            }
        }

        $user = session('user');
        $data = [
            'user_id'               => $user['id'] ?? null,
            'nama_suami'            => $this->request->getPost('nama_suami'),
            'nik_suami'             => $this->request->getPost('nik_suami'),
            'tempat_lahir_suami'    => $this->request->getPost('tempat_lahir_suami'),
            'tanggal_lahir_suami'   => $this->request->getPost('tanggal_lahir_suami'),
            'agama_suami'           => $this->request->getPost('agama_suami'),
            'alamat_suami'          => $this->request->getPost('alamat_suami'),
            'nama_istri'            => $this->request->getPost('nama_istri'),
            'nik_istri'             => $this->request->getPost('nik_istri'),
            'tempat_lahir_istri'    => $this->request->getPost('tempat_lahir_istri'),
            'tanggal_lahir_istri'   => $this->request->getPost('tanggal_lahir_istri'),
            'agama_istri'           => $this->request->getPost('agama_istri'),
            'alamat_istri'          => $this->request->getPost('alamat_istri'),
            'tanggal_perkawinan'    => $this->request->getPost('tanggal_perkawinan'),
            'tempat_perkawinan'     => $this->request->getPost('tempat_perkawinan'),
            'file_ktp_suami'        => $dataFile['file_ktp_suami'] ?? null,
            'file_ktp_istri'        => $dataFile['file_ktp_istri'] ?? null,
            'file_kk'               => $dataFile['file_kk'] ?? null,
            'file_buku_nikah'       => $dataFile['file_buku_nikah'] ?? null,
            'file_surat_perkawinan' => $dataFile['file_surat_perkawinan'] ?? null,
            'status_pengajuan'      => 'Selesai'
        ];

        $insert = $this->perkawinanModel->insert($data);
        $lastId = $this->perkawinanModel->getInsertID();

        if ($insert) {
            // Generate PDF
            $pengajuan = $this->perkawinanModel->find($lastId);
            $pdfData = [
                'nomor_akte'            => 'AKTE-NIKAH-' . str_pad($lastId, 6, '0', STR_PAD_LEFT),
                'nama_suami'            => $pengajuan['nama_suami'],
                'nik_suami'             => $pengajuan['nik_suami'],
                'tempat_lahir_suami'    => $pengajuan['tempat_lahir_suami'],
                'tanggal_lahir_suami'   => $pengajuan['tanggal_lahir_suami'],
                'agama_suami'           => $pengajuan['agama_suami'],
                'alamat_suami'          => $pengajuan['alamat_suami'],
                'nama_istri'            => $pengajuan['nama_istri'],
                'nik_istri'             => $pengajuan['nik_istri'],
                'tempat_lahir_istri'    => $pengajuan['tempat_lahir_istri'],
                'tanggal_lahir_istri'   => $pengajuan['tanggal_lahir_istri'],
                'agama_istri'           => $pengajuan['agama_istri'],
                'alamat_istri'          => $pengajuan['alamat_istri'],
                'tanggal_perkawinan'    => $pengajuan['tanggal_perkawinan'],
                'tempat_perkawinan'     => $pengajuan['tempat_perkawinan'],
                'tanggal_pencatatan'    => date('Y-m-d'),
            ];
            $html = view('pdf/aktePerkawinan_pdf', $pdfData);

            $dompdf = new \Dompdf\Dompdf();
            $dompdf->loadHtml($html);
            $dompdf->setPaper('A4', 'portrait');
            $dompdf->render();

            $pdfName = 'akte-perkawinan-' . $lastId . '-' . time() . '.pdf';
            file_put_contents($path . $pdfName, $dompdf->output());

            $this->perkawinanModel->update($lastId, [
                'file_pdf' => 'uploads/akteperkawinan/' . $pdfName
            ]);

            return $this->response->setJSON([
                'status' => 'success',
                'message' => "Pengajuan berhasil disimpan! Akte Perkawinan digital bisa diunduh dari riwayat.",
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
        $riwayat = $this->perkawinanModel
            ->where('user_id', $userId)
            ->orderBy('id', 'DESC')
            ->findAll();

        return view('home/Form/Akteperkawinan/riwayat', [
            'title'   => 'Riwayat Pengajuan Akte Perkawinan',
            'riwayat' => $riwayat
        ]);
    }

    public function downloadAkte($id)
    {
        $pengajuan = $this->perkawinanModel->find($id);

        if (!$pengajuan || $pengajuan['user_id'] != session('user.id')) {
            return redirect()->to('/')->with('error', 'Akses ditolak');
        }

        $pdfPath = WRITEPATH . $pengajuan['file_pdf'];
        if (!file_exists($pdfPath)) {
            return redirect()->back()->with('error', 'File tidak ditemukan');
        }

        return $this->response
            ->setHeader('Content-Type', 'application/pdf')
            ->setHeader('Content-Disposition', 'attachment; filename="Akte-Perkawinan-'.$pengajuan['id'].'.pdf"')
            ->setBody(file_get_contents($pdfPath));
    }
}
