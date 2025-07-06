<?php
namespace App\Controllers\Form;

use App\Controllers\BaseController;
use App\Models\AkteKematianModel;

class AkteKematianController extends BaseController
{
    protected $kematianModel;

    public function __construct()
    {
        $this->kematianModel = new AkteKematianModel();
    }

    // Form page
    public function index()
    {
        $data = [
            'title' => 'Form Pengajuan Akte Kematian',
            'user'  => session()->get('user')
        ];
        return view('home/form/Aktekematian/AkteKematian', $data);
    }

    // Proses form via AJAX
    public function prosesAkteAjax()
    {
        $validation = \Config\Services::validation();
        $rules = [
            'nama_meninggal'   => 'required|min_length[3]',
            'nik_meninggal'    => 'required|numeric|exact_length[16]',
            'tempat_meninggal' => 'required',
            'tanggal_meninggal'=> 'required',
            'jenis_kelamin'    => 'required',
            'agama'            => 'required',
            'alamat'           => 'required',
            'penyebab_kematian'=> 'required',
            'nama_pelapor'     => 'required',
            'nik_pelapor'      => 'required|numeric|exact_length[16]',
            'hubungan_pelapor' => 'required'
        ];
        if (!$this->validate($rules)) {
            return $this->response->setJSON([
                'status' => 'error',
                'message' => 'Validasi gagal',
                'errors' => $validation->getErrors()
            ]);
        }

        // Handle upload file
        $path = WRITEPATH . 'uploads/aktekematian/';
        if (!is_dir($path)) mkdir($path, 0777, true);
        $dataFile = [];
        foreach (['file_kk','file_ktp_pelapor','file_surat_kematian'] as $fileField) {
            $file = $this->request->getFile($fileField);
            if ($file && $file->isValid()) {
                $newName = $fileField . '-' . time() . '.' . $file->getExtension();
                $file->move($path, $newName);
                $dataFile[$fileField] = 'uploads/aktekematian/' . $newName;
            }
        }

        $user = session('user');
        $data = [
            'user_id'            => $user['id'] ?? null,
            'nama_meninggal'     => $this->request->getPost('nama_meninggal'),
            'nik_meninggal'      => $this->request->getPost('nik_meninggal'),
            'tempat_meninggal'   => $this->request->getPost('tempat_meninggal'),
            'tanggal_meninggal'  => $this->request->getPost('tanggal_meninggal'),
            'jenis_kelamin'      => $this->request->getPost('jenis_kelamin'),
            'agama'              => $this->request->getPost('agama'),
            'alamat'             => $this->request->getPost('alamat'),
            'penyebab_kematian'  => $this->request->getPost('penyebab_kematian'),
            'nama_pelapor'       => $this->request->getPost('nama_pelapor'),
            'nik_pelapor'        => $this->request->getPost('nik_pelapor'),
            'hubungan_pelapor'   => $this->request->getPost('hubungan_pelapor'),
            'file_kk'            => $dataFile['file_kk'] ?? null,
            'file_ktp_pelapor'   => $dataFile['file_ktp_pelapor'] ?? null,
            'file_surat_kematian'=> $dataFile['file_surat_kematian'] ?? null,
            'status_pengajuan'   => 'Selesai'
        ];

        $insert = $this->kematianModel->insert($data);
        $lastId = $this->kematianModel->getInsertID();

        if ($insert) {
            // Generate PDF Otomatis
            $pengajuan = $this->kematianModel->find($lastId);
            $pdfData = [
                'nomor_akte'        => 'AKTKEM-' . str_pad($lastId, 6, '0', STR_PAD_LEFT),
                'nama_meninggal'    => $pengajuan['nama_meninggal'],
                'nik_meninggal'     => $pengajuan['nik_meninggal'],
                'tempat_meninggal'  => $pengajuan['tempat_meninggal'],
                'tanggal_meninggal' => $pengajuan['tanggal_meninggal'],
                'jenis_kelamin'     => $pengajuan['jenis_kelamin'],
                'agama'             => $pengajuan['agama'],
                'alamat'            => $pengajuan['alamat'],
                'penyebab_kematian' => $pengajuan['penyebab_kematian'],
                'nama_pelapor'      => $pengajuan['nama_pelapor'],
                'nik_pelapor'       => $pengajuan['nik_pelapor'],
                'hubungan_pelapor'  => $pengajuan['hubungan_pelapor'],
                'tempat_pencatatan' => 'Kantor Disdukcapil',
                'tanggal_pencatatan'=> date('Y-m-d'),
            ];
            $html = view('pdf/akteKematian_pdf', $pdfData);

            $dompdf = new \Dompdf\Dompdf();
            $dompdf->loadHtml($html);
            $dompdf->setPaper('A4', 'portrait');
            $dompdf->render();

            $pdfName = 'akte-kematian-' . $lastId . '-' . time() . '.pdf';
            file_put_contents($path . $pdfName, $dompdf->output());

            // Update path file_pdf
            $this->kematianModel->update($lastId, [
                'file_pdf' => 'uploads/aktekematian/' . $pdfName
            ]);

            return $this->response->setJSON([
                'status' => 'success',
                'message' => "Pengajuan berhasil disimpan! Akte Kematian digital bisa diunduh dari riwayat.",
                'id' => $lastId
            ]);
        } else {
            return $this->response->setJSON([
                'status' => 'error',
                'message' => 'Gagal simpan data. Coba ulangi!'
            ]);
        }
    }

    // Riwayat
    public function riwayat()
    {
        $userId = session('user.id');
        $riwayat = $this->kematianModel
            ->where('user_id', $userId)
            ->orderBy('id', 'DESC')
            ->findAll();

        return view('home/Form/Aktekematian/riwayat', [
            'title'   => 'Riwayat Pengajuan Akte Kematian',
            'riwayat' => $riwayat
        ]);
    }

    // Download PDF
    public function downloadAkte($id)
    {
        $pengajuan = $this->kematianModel->find($id);

        if (!$pengajuan || $pengajuan['user_id'] != session('user.id')) {
            return redirect()->to('/')->with('error', 'Akses ditolak');
        }

        $pdfPath = WRITEPATH . $pengajuan['file_pdf'];
        if (!file_exists($pdfPath)) {
            return redirect()->back()->with('error', 'File tidak ditemukan');
        }

        return $this->response
            ->setHeader('Content-Type', 'application/pdf')
            ->setHeader('Content-Disposition', 'attachment; filename="Akte-Kematian-'.$pengajuan['id'].'.pdf"')
            ->setBody(file_get_contents($pdfPath));
    }
}
