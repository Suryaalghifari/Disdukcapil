<?php
namespace App\Controllers\Form;

use App\Controllers\BaseController;
use App\Models\PengajuanKtpModel;
use App\Models\KtpModel;
use Mpdf\Mpdf;

class FormController extends BaseController
{
    protected $ktpModel;

    public function __construct()
    {
        $this->ktpModel = new KtpModel();
    }

    public function ktp()
    {
        $data = [
            'title' => 'Form Pengajuan KTP Elektronik',
            'user'  => session()->get('user')
        ];
        return view('home/Form/ktp', $data);
    }

    public function prosesKtpAjax()
    {
        $validation = \Config\Services::validation();
        $rules = [
            'nik' => 'required|exact_length[16]',
            'nama_lengkap' => 'required|min_length[3]',
            'tempat_lahir' => 'required',
            'tanggal_lahir' => 'required',
            'jenis_kelamin' => 'required',
            'agama' => 'required',
            'status_perkawinan' => 'required',
            'pekerjaan' => 'required',
            'alamat' => 'required',
            'rt' => 'required',
            'rw' => 'required',
            'kelurahan' => 'required',
            'kecamatan' => 'required',
            'file-kk'   => 'uploaded[file-kk]|max_size[file-kk,2048]|ext_in[file-kk,pdf,jpg,jpeg]',
            'file-akta' => 'uploaded[file-akta]|max_size[file-akta,2048]|ext_in[file-akta,pdf,jpg,jpeg]',
            'file-foto' => 'uploaded[file-foto]|max_size[file-foto,1024]|ext_in[file-foto,jpg,jpeg]',
        ];

        if (!$this->validate($rules)) {
            return $this->response->setJSON([
                'status' => 'error',
                'message' => 'Validasi gagal',
                'errors' => $validation->getErrors()
            ]);
        }

        $path = WRITEPATH . 'uploads/ktp/';
        if (!is_dir($path)) mkdir($path, 0777, true);
        $dataFile = [];
        foreach (['file-kk','file-akta','file-foto','file-nikah'] as $fileField) {
            $file = $this->request->getFile($fileField);
            if ($file && $file->isValid()) {
                $newName = $fileField . '-' . time() . '.' . $file->getExtension();
                $file->move($path, $newName);
                $dataFile[$fileField] = 'uploads/ktp/' . $newName;
            }
        }

        $user = session('user');
        $data = [
            'user_id'           => $user['id'] ?? null,
            'nik'               => $this->request->getPost('nik'),
            'nama_lengkap'      => $this->request->getPost('nama_lengkap'),
            'tempat_lahir'      => $this->request->getPost('tempat_lahir'),
            'tanggal_lahir'     => $this->request->getPost('tanggal_lahir'),
            'jenis_kelamin'     => $this->request->getPost('jenis_kelamin'),
            'agama'             => $this->request->getPost('agama'),
            'status_perkawinan' => $this->request->getPost('status_perkawinan'),
            'pekerjaan'         => $this->request->getPost('pekerjaan'),
            'alamat'            => $this->request->getPost('alamat'),
            'rt'                => $this->request->getPost('rt'),
            'rw'                => $this->request->getPost('rw'),
            'kelurahan'         => $this->request->getPost('kelurahan'),
            'kecamatan'         => $this->request->getPost('kecamatan'),
            'file_kk'           => $dataFile['file-kk'] ?? null,
            'file_akta'         => $dataFile['file-akta'] ?? null,
            'file_nikah'        => $dataFile['file-nikah'] ?? null,
            'file_foto'         => $dataFile['file-foto'] ?? null,
            'status_pengajuan'  => 'Selesai'
        ];

        $model = new PengajuanKtpModel();
        $insert = $model->insert($data);
        $lastId = $model->getInsertID();

        if ($insert) {
            // Buat PDF TANPA background image agar anti error!
            $ktpData = [
                'nik' => $data['nik'],
                'nama' => $data['nama_lengkap'],
                'tempat_lahir' => $data['tempat_lahir'],
                'tanggal_lahir' => $data['tanggal_lahir'],
                'jenis_kelamin' => $data['jenis_kelamin'],
                'alamat' => $data['alamat'],
                'rt' => $data['rt'],
                'rw' => $data['rw'],
                'kelurahan' => $data['kelurahan'],
                'kecamatan' => $data['kecamatan'],
                'agama' => $data['agama'],
                'status_perkawinan' => $data['status_perkawinan'],
                'pekerjaan' => $data['pekerjaan'],
                'gol_darah' => '-'
            ];

            $htmlKtp = view('pdf/ktp_pdf', $ktpData);
            $mpdf = new \Mpdf\Mpdf([
                'format' => 'A5-L',
                'margin_left' => 0,
                'margin_right' => 0,
                'margin_top' => 0,
                'margin_bottom' => 0,
            ]);
            $pdfFilename = 'ktp-digital-' . $lastId . '.pdf';
            $pdfPath = WRITEPATH . 'uploads/ktp/' . $pdfFilename;
            $mpdf->WriteHTML($htmlKtp);
            $mpdf->Output($pdfPath, \Mpdf\Output\Destination::FILE);
            
            if (!empty($pdfFilename)) {
                $model->update($lastId, ['file_pdf' => $pdfFilename]);
            }
        }
        

        if ($insert) {
            return $this->response->setJSON([
                'status' => 'success',
                'message' => "Pengajuan berhasil disimpan! KTP digital bisa diunduh dari riwayat.",
                'id' => $lastId,
                'application_number' => 'KTP-2024-' . str_pad($lastId, 6, '0', STR_PAD_LEFT),
                'application_date' => date('Y-m-d')
            ]);
        } else {
            return $this->response->setJSON([
                'status' => 'error',
                'message' => 'Gagal simpan data. Coba ulangi!'
            ]);
        }


        
}

        public function downloadKtp($id)
        {
            $pengajuan = $this->ktpModel->find($id);

            // Cek: data ada dan milik user yang sedang login
            if (!$pengajuan || $pengajuan['user_id'] != session('user.id')) {
                return redirect()->to('/')->with('error', 'Akses ditolak');
            }

            $pdfPath = WRITEPATH . 'uploads/ktp/' . ($pengajuan['file_pdf'] ?? '');
            if (!file_exists($pdfPath)) {
                return redirect()->back()->with('error', 'File tidak ditemukan');
            }

            return $this->response
                ->setHeader('Content-Type', 'application/pdf')
                ->setHeader('Content-Disposition', 'attachment; filename="KTP-Digital-'.$pengajuan['id'].'.pdf"')
                ->setBody(file_get_contents($pdfPath));
        }

         public function riwayat()
        {
            $userId = session('user.id');
            $model = new PengajuanKtpModel();

            // Ambil semua riwayat pengajuan milik user yang sedang login
            $riwayat = $model->where('user_id', $userId)->orderBy('id', 'DESC')->findAll();

            // Kirim ke view riwayat
            return view('home/riwayat', [
                'title' => 'Riwayat Pengajuan KTP Digital',
                'riwayat' => $riwayat
            ]);
        }
}
