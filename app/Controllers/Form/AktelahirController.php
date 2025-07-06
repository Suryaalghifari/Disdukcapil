<?php
namespace App\Controllers\Form;

use App\Controllers\BaseController;
use App\Models\AkteKelahiranModel;


class AkteLahirController extends BaseController
{
    protected $akteModel;

    public function __construct()
    {
        $this->akteModel = new AkteKelahiranModel();
    }

    // 1. Form page
    public function index()
    {
        $data = [
            'title' => 'Form Pengajuan Akte Kelahiran',
            'user'  => session()->get('user')
        ];
        return view('home/form/Aktekelahiran/AkteKelahiran', $data);
    }

    // 2. AJAX proses
    public function prosesAkteAjax()
    {
        $validation = \Config\Services::validation();
        $rules = [
            'nama_lengkap'   => 'required|min_length[3]',
            'tempat_lahir'   => 'required',
            'tanggal_lahir'  => 'required',
            'jenis_kelamin'  => 'required',
            'nama_ayah'      => 'required',
            'nama_ibu'       => 'required',
            'alamat'         => 'required',
            'kelurahan'      => 'required',
            'kecamatan'      => 'required',
            // file rules bisa dikembangkan
        ];
        if (!$this->validate($rules)) {
            return $this->response->setJSON([
                'status' => 'error',
                'message' => 'Validasi gagal',
                'errors' => $validation->getErrors()
            ]);
        }
    
        // Handle upload file
        $path = WRITEPATH . 'uploads/aktekelahiran/';
        if (!is_dir($path)) mkdir($path, 0777, true);
        $dataFile = [];
        foreach (['file_kk','file_surat_lahir','file_ktp_ortu'] as $fileField) {
            $file = $this->request->getFile($fileField);
            if ($file && $file->isValid()) {
                $newName = $fileField . '-' . time() . '.' . $file->getExtension();
                $file->move($path, $newName);
                $dataFile[$fileField] = 'uploads/aktekelahiran/' . $newName;
            }
        }
    
        $user = session('user');
        $data = [
            'user_id'           => $user['id'] ?? null,
            'nama_lengkap'      => $this->request->getPost('nama_lengkap'),
            'tempat_lahir'      => $this->request->getPost('tempat_lahir'),
            'tanggal_lahir'     => $this->request->getPost('tanggal_lahir'),
            'jenis_kelamin'     => $this->request->getPost('jenis_kelamin'),
            'agama'             => $this->request->getPost('agama'),
            'nama_ayah'         => $this->request->getPost('nama_ayah'),
            'nik_ayah'          => $this->request->getPost('nik_ayah'),
            'nama_ibu'          => $this->request->getPost('nama_ibu'),
            'nik_ibu'           => $this->request->getPost('nik_ibu'),
            'alamat'            => $this->request->getPost('alamat'),
            'kelurahan'         => $this->request->getPost('kelurahan'),
            'kecamatan'         => $this->request->getPost('kecamatan'),
            'tempat_perkawinan' => $this->request->getPost('tempat_perkawinan'),
            'tanggal_perkawinan'=> $this->request->getPost('tanggal_perkawinan'),
            'file_kk'           => $dataFile['file_kk'] ?? null,
            'file_surat_lahir'  => $dataFile['file_surat_lahir'] ?? null,
            'file_ktp_ortu'     => $dataFile['file_ktp_ortu'] ?? null,
            'status_pengajuan'  => 'Selesai'
        ];
    
        $insert = $this->akteModel->insert($data);
        $lastId = $this->akteModel->getInsertID();
    
        if ($insert) {
            // === Generate PDF Otomatis ===
            $pengajuan = $this->akteModel->find($lastId);
            $pdfData = [
                'nomor_akte' => 'AKTE-' . str_pad($lastId, 6, '0', STR_PAD_LEFT),
                'nama_lengkap' => $pengajuan['nama_lengkap'],
                'tempat_lahir' => $pengajuan['tempat_lahir'],
                'tanggal_lahir' => $pengajuan['tanggal_lahir'],
                'jenis_kelamin' => $pengajuan['jenis_kelamin'],
                'agama' => $pengajuan['agama'],
                'alamat' => $pengajuan['alamat'],
                'kelurahan' => $pengajuan['kelurahan'],
                'kecamatan' => $pengajuan['kecamatan'],
                'nama_ayah' => $pengajuan['nama_ayah'],
                'nik_ayah' => $pengajuan['nik_ayah'],
                'nama_ibu' => $pengajuan['nama_ibu'],
                'nik_ibu' => $pengajuan['nik_ibu'],
                'tempat_pencatatan' => 'Kantor Disdukcapil',
                'tanggal_pencatatan' => date('Y-m-d'),
            ];
            $html = view('pdf/akteKelahiran_pdf', $pdfData);
    
            // Pastikan sudah require Dompdf di composer dan autoload
            $dompdf = new \Dompdf\Dompdf();
            $dompdf->loadHtml($html);
            $dompdf->setPaper('A4', 'portrait');
            $dompdf->render();
    
            $pdfName = 'akte-' . $lastId . '-' . time() . '.pdf';
            file_put_contents($path . $pdfName, $dompdf->output());
    
            // Update path file_pdf
            $this->akteModel->update($lastId, [
                'file_pdf' => 'uploads/aktekelahiran/' . $pdfName
            ]);
    
            return $this->response->setJSON([
                'status' => 'success',
                'message' => "Pengajuan berhasil disimpan! Akte Kelahiran digital bisa diunduh dari riwayat.",
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
        $riwayat = $this->akteModel
            ->where('user_id', $userId)
            ->orderBy('id', 'DESC')
            ->findAll();

        return view('home/Form/Aktekelahiran/riwayatAkteKelahiran', [
            'title'   => 'Riwayat Pengajuan Akte Kelahiran',
            'riwayat' => $riwayat
        ]);
    }
    public function downloadAkte($id)
{
    $pengajuan = $this->akteModel->find($id);

    if (!$pengajuan || $pengajuan['user_id'] != session('user.id')) {
        return redirect()->to('/')->with('error', 'Akses ditolak');
    }

    $pdfPath = WRITEPATH . $pengajuan['file_pdf'];
    if (!file_exists($pdfPath)) {
        return redirect()->back()->with('error', 'File tidak ditemukan');
    }

    return $this->response
        ->setHeader('Content-Type', 'application/pdf')
        ->setHeader('Content-Disposition', 'attachment; filename="Akte-Kelahiran-'.$pengajuan['id'].'.pdf"')
        ->setBody(file_get_contents($pdfPath));
}


}    
