<?php
namespace App\Controllers\Form;

use App\Controllers\BaseController;
use App\Models\KeteranganPindahModel;

class KeteranganPindahController extends BaseController
{
    protected $pindahModel;

    public function __construct()
    {
        $this->pindahModel = new KeteranganPindahModel();
    }

    public function index()
    {
        $data = [
            'title' => 'Form Surat Keterangan Pindah',
            'user'  => session()->get('user')
        ];
        return view('home/Form/Keteranganpindah/KeteranganPindah', $data);
    }

    public function prosesPindahAjax()
    {
        $validation = \Config\Services::validation();
        $rules = [
            'nama_pemohon'      => 'required|min_length[3]',
            'nik_pemohon'       => 'required|numeric|exact_length[16]',
            'alamat_asal'       => 'required',
            'kelurahan_asal'    => 'required',
            'kecamatan_asal'    => 'required',
            'kabupaten_asal'    => 'required',
            'provinsi_asal'     => 'required',
            'alamat_tujuan'     => 'required',
            'kelurahan_tujuan'  => 'required',
            'kecamatan_tujuan'  => 'required',
            'kabupaten_tujuan'  => 'required',
            'provinsi_tujuan'   => 'required',
            'alasan_pindah'     => 'required',
            'jumlah_anggota_pindah' => 'required|integer'
        ];
        if (!$this->validate($rules)) {
            return $this->response->setJSON([
                'status' => 'error',
                'message' => 'Validasi gagal',
                'errors' => $validation->getErrors()
            ]);
        }

        // Upload file
        $path = WRITEPATH . 'uploads/keteranganpindah/';
        if (!is_dir($path)) mkdir($path, 0777, true);
        $dataFile = [];
        foreach (['file_kk','file_ktp','file_pengantar_rt'] as $fileField) {
            $file = $this->request->getFile($fileField);
            if ($file && $file->isValid()) {
                $newName = $fileField . '-' . time() . '.' . $file->getExtension();
                $file->move($path, $newName);
                $dataFile[$fileField] = 'uploads/keteranganpindah/' . $newName;
            }
        }

        $user = session('user');
        $data = [
            'user_id'           => $user['id'] ?? null,
            'nama_pemohon'      => $this->request->getPost('nama_pemohon'),
            'nik_pemohon'       => $this->request->getPost('nik_pemohon'),
            'alamat_asal'       => $this->request->getPost('alamat_asal'),
            'rt_asal'           => $this->request->getPost('rt_asal'),
            'rw_asal'           => $this->request->getPost('rw_asal'),
            'kelurahan_asal'    => $this->request->getPost('kelurahan_asal'),
            'kecamatan_asal'    => $this->request->getPost('kecamatan_asal'),
            'kabupaten_asal'    => $this->request->getPost('kabupaten_asal'),
            'provinsi_asal'     => $this->request->getPost('provinsi_asal'),
            'alamat_tujuan'     => $this->request->getPost('alamat_tujuan'),
            'rt_tujuan'         => $this->request->getPost('rt_tujuan'),
            'rw_tujuan'         => $this->request->getPost('rw_tujuan'),
            'kelurahan_tujuan'  => $this->request->getPost('kelurahan_tujuan'),
            'kecamatan_tujuan'  => $this->request->getPost('kecamatan_tujuan'),
            'kabupaten_tujuan'  => $this->request->getPost('kabupaten_tujuan'),
            'provinsi_tujuan'   => $this->request->getPost('provinsi_tujuan'),
            'alasan_pindah'     => $this->request->getPost('alasan_pindah'),
            'jumlah_anggota_pindah' => $this->request->getPost('jumlah_anggota_pindah'),
            'file_kk'           => $dataFile['file_kk'] ?? null,
            'file_ktp'          => $dataFile['file_ktp'] ?? null,
            'file_pengantar_rt' => $dataFile['file_pengantar_rt'] ?? null,
            'status_pengajuan'  => 'Selesai'
        ];

        $insert = $this->pindahModel->insert($data);
        $lastId = $this->pindahModel->getInsertID();

        if ($insert) {
            // Generate PDF
            $pengajuan = $this->pindahModel->find($lastId);
            $pdfData = [
                'nomor_pindah'      => 'PINDAH-' . str_pad($lastId, 6, '0', STR_PAD_LEFT),
                'nama_pemohon'      => $pengajuan['nama_pemohon'],
                'nik_pemohon'       => $pengajuan['nik_pemohon'],
                'alamat_asal'       => $pengajuan['alamat_asal'],
                'kelurahan_asal'    => $pengajuan['kelurahan_asal'],
                'kecamatan_asal'    => $pengajuan['kecamatan_asal'],
                'kabupaten_asal'    => $pengajuan['kabupaten_asal'],
                'provinsi_asal'     => $pengajuan['provinsi_asal'],
                'alamat_tujuan'     => $pengajuan['alamat_tujuan'],
                'kelurahan_tujuan'  => $pengajuan['kelurahan_tujuan'],
                'kecamatan_tujuan'  => $pengajuan['kecamatan_tujuan'],
                'kabupaten_tujuan'  => $pengajuan['kabupaten_tujuan'],
                'provinsi_tujuan'   => $pengajuan['provinsi_tujuan'],
                'alasan_pindah'     => $pengajuan['alasan_pindah'],
                'jumlah_anggota_pindah' => $pengajuan['jumlah_anggota_pindah'],
                'tanggal_pengajuan' => date('Y-m-d'),
            ];
            $html = view('pdf/keteranganPindah_pdf', $pdfData);

            $dompdf = new \Dompdf\Dompdf();
            $dompdf->loadHtml($html);
            $dompdf->setPaper('A4', 'portrait');
            $dompdf->render();

            $pdfName = 'keterangan-pindah-' . $lastId . '-' . time() . '.pdf';
            file_put_contents($path . $pdfName, $dompdf->output());

            $this->pindahModel->update($lastId, [
                'file_pdf' => 'uploads/keteranganpindah/' . $pdfName
            ]);

            return $this->response->setJSON([
                'status' => 'success',
                'message' => "Pengajuan berhasil disimpan! Surat Keterangan Pindah digital bisa diunduh dari riwayat.",
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
        $riwayat = $this->pindahModel
            ->where('user_id', $userId)
            ->orderBy('id', 'DESC')
            ->findAll();

        return view('home/Form/KeteranganPindah/riwayat', [
            'title'   => 'Riwayat Pengajuan Surat Keterangan Pindah',
            'riwayat' => $riwayat
        ]);
    }

    public function downloadPindah($id)
    {
        $pengajuan = $this->pindahModel->find($id);

        if (!$pengajuan || $pengajuan['user_id'] != session('user.id')) {
            return redirect()->to('/')->with('error', 'Akses ditolak');
        }

        $pdfPath = WRITEPATH . $pengajuan['file_pdf'];
        if (!file_exists($pdfPath)) {
            return redirect()->back()->with('error', 'File tidak ditemukan');
        }

        return $this->response
            ->setHeader('Content-Type', 'application/pdf')
            ->setHeader('Content-Disposition', 'attachment; filename="Keterangan-Pindah-'.$pengajuan['id'].'.pdf"')
            ->setBody(file_get_contents($pdfPath));
    }
}
