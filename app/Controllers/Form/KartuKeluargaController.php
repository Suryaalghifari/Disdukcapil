<?php
namespace App\Controllers\Form;

use App\Controllers\BaseController;
use App\Models\KartuKeluargaModel;

class KartuKeluargaController extends BaseController
{
    protected $kkModel;

    public function __construct()
    {
        $this->kkModel = new KartuKeluargaModel();
    }

    public function index()
    {
        $data = [
            'title' => 'Form Pengajuan Kartu Keluarga',
            'user'  => session()->get('user')
        ];
        return view('home/Form/Kartukeluarga/KartuKeluarga', $data);
    }

    public function prosesKkAjax()
    {
        $validation = \Config\Services::validation();
        $rules = [
            'nama_kepala_keluarga' => 'required|numeric|exact_length[16]',
            'nik_kepala_keluarga'  => 'required',
            'alamat'               => 'required',
            'rt'                   => 'required',
            'rw'                   => 'required',
            'kelurahan'            => 'required',
            'kecamatan'            => 'required',
            'kode_pos'             => 'required'
        ];
        if (!$this->validate($rules)) {
            return $this->response->setJSON([
                'status' => 'error',
                'message' => 'Validasi gagal',
                'errors' => $validation->getErrors()
            ]);
        }

        // Upload file
        $path = WRITEPATH . 'uploads/kartukeluarga/';
        if (!is_dir($path)) mkdir($path, 0777, true);
        $dataFile = [];
        foreach (['file_ktp_kepala','file_pengantar_rt','file_lampiran_kk_lama'] as $fileField) {
            $file = $this->request->getFile($fileField);
            if ($file && $file->isValid()) {
                $newName = $fileField . '-' . time() . '.' . $file->getExtension();
                $file->move($path, $newName);
                $dataFile[$fileField] = 'uploads/kartukeluarga/' . $newName;
            }
        }

        $user = session('user');
        $data = [
            'user_id'               => $user['id'] ?? null,
            'nama_kepala_keluarga'  => $this->request->getPost('nama_kepala_keluarga'),
            'nik_kepala_keluarga'   => $this->request->getPost('nik_kepala_keluarga'),
            'alamat'                => $this->request->getPost('alamat'),
            'rt'                    => $this->request->getPost('rt'),
            'rw'                    => $this->request->getPost('rw'),
            'kelurahan'             => $this->request->getPost('kelurahan'),
            'kecamatan'             => $this->request->getPost('kecamatan'),
            'kode_pos'              => $this->request->getPost('kode_pos'),
            'file_ktp_kepala'       => $dataFile['file_ktp_kepala'] ?? null,
            'file_pengantar_rt'     => $dataFile['file_pengantar_rt'] ?? null,
            'file_lampiran_kk_lama' => $dataFile['file_lampiran_kk_lama'] ?? null,
            'status_pengajuan'      => 'Selesai'
        ];

        $insert = $this->kkModel->insert($data);
        $lastId = $this->kkModel->getInsertID();

        if ($insert) {
            // Ambil data yang baru saja diinput
            $pengajuan = $this->kkModel->find($lastId);
        
            // Siapkan data untuk template PDF
            $pdfData = [
                'nomor_pengajuan' => 'KK-' . str_pad($lastId, 6, '0', STR_PAD_LEFT),
                'nama_kepala_keluarga' => $pengajuan['nama_kepala_keluarga'],
                'nik_kepala_keluarga'  => $pengajuan['nik_kepala_keluarga'],
                'alamat'               => $pengajuan['alamat'],
                'rt'                   => $pengajuan['rt'],
                'rw'                   => $pengajuan['rw'],
                'kelurahan'            => $pengajuan['kelurahan'],
                'kecamatan'            => $pengajuan['kecamatan'],
                'kode_pos'             => $pengajuan['kode_pos'],
                'tanggal_pengajuan'    => date('Y-m-d'),
            ];
        
            // Render HTML untuk PDF dari view
            $html = view('pdf/kartuKeluarga_pdf', $pdfData);
        
            // Generate PDF
            $dompdf = new \Dompdf\Dompdf();
            $dompdf->loadHtml($html);
            $dompdf->setPaper('A4', 'portrait');
            $dompdf->render();
        
            // Simpan file PDF
            $pdfName = 'kk-' . $lastId . '-' . time() . '.pdf';
            $filePath = $path . $pdfName;
            file_put_contents($filePath, $dompdf->output());
        
            // Update path file_pdf di database
            $this->kkModel->update($lastId, [
                'file_pdf' => 'uploads/kartukeluarga/' . $pdfName
            ]);
        
            return $this->response->setJSON([
                'status' => 'success',
                'message' => "Pengajuan berhasil disimpan! File PDF Kartu Keluarga bisa diunduh dari riwayat.",
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
        $riwayat = $this->kkModel
            ->where('user_id', $userId)
            ->orderBy('id', 'DESC')
            ->findAll();

        return view('home/Form/KartuKeluarga/riwayat', [
            'title'   => 'Riwayat Pengajuan KK',
            'riwayat' => $riwayat
        ]);
    }

    public function downloadKk($id)
    {
        $pengajuan = $this->kkModel->find($id);

        if (!$pengajuan || $pengajuan['user_id'] != session('user.id')) {
            return redirect()->to('/')->with('error', 'Akses ditolak');
        }

        $pdfPath = WRITEPATH . $pengajuan['file_pdf'];
        if (!file_exists($pdfPath)) {
            return redirect()->back()->with('error', 'File tidak ditemukan');
        }

        return $this->response
            ->setHeader('Content-Type', 'application/pdf')
            ->setHeader('Content-Disposition', 'attachment; filename="Kartu-Keluarga-'.$pengajuan['id'].'.pdf"')
            ->setBody(file_get_contents($pdfPath));
    }
}
