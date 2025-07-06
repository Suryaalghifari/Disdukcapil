<?php
namespace App\Controllers\Form;

use App\Controllers\BaseController;
use App\Models\KartuIdentitasAnakModel;

class KartuIdentitasAnakController extends BaseController
{
    protected $kiaModel;

    public function __construct()
    {
        $this->kiaModel = new KartuIdentitasAnakModel();
    }

    public function index()
    {
        $data = [
            'title' => 'Form Pengajuan Kartu Identitas Anak (KIA)',
            'user'  => session()->get('user')
        ];
        return view('home/Form/KIA/KartuIdentitasAnak', $data);
    }

    public function prosesKiaAjax()
    {
        $validation = \Config\Services::validation();
        $rules = [
            'nama_anak'      => 'required|min_length[3]',
            'nik_anak'       => 'required|numeric|exact_length[16]',
            'tempat_lahir'   => 'required',
            'tanggal_lahir'  => 'required',
            'jenis_kelamin'  => 'required',
            'agama'          => 'required',
            'alamat'         => 'required',
            'nama_ayah'      => 'required',
            'nik_ayah'       => 'required',
            'nama_ibu'       => 'required',
            'nik_ibu'        => 'required',
        ];
        if (!$this->validate($rules)) {
            return $this->response->setJSON([
                'status' => 'error',
                'message' => 'Validasi gagal',
                'errors' => $validation->getErrors()
            ]);
        }

        // Upload file
        $path = WRITEPATH . 'uploads/kia/';
        if (!is_dir($path)) mkdir($path, 0777, true);
        $dataFile = [];
        foreach (['file_akte_lahir','file_kk','file_ktp_ortu','file_pas_foto'] as $fileField) {
            $file = $this->request->getFile($fileField);
            if ($file && $file->isValid()) {
                $newName = $fileField . '-' . time() . '.' . $file->getExtension();
                $file->move($path, $newName);
                $dataFile[$fileField] = 'uploads/kia/' . $newName;
            }
        }

        $user = session('user');
        $data = [
            'user_id'           => $user['id'] ?? null,
            'nama_anak'         => $this->request->getPost('nama_anak'),
            'nik_anak'          => $this->request->getPost('nik_anak'),
            'tempat_lahir'      => $this->request->getPost('tempat_lahir'),
            'tanggal_lahir'     => $this->request->getPost('tanggal_lahir'),
            'jenis_kelamin'     => $this->request->getPost('jenis_kelamin'),
            'agama'             => $this->request->getPost('agama'),
            'alamat'            => $this->request->getPost('alamat'),
            'nama_ayah'         => $this->request->getPost('nama_ayah'),
            'nik_ayah'          => $this->request->getPost('nik_ayah'),
            'nama_ibu'          => $this->request->getPost('nama_ibu'),
            'nik_ibu'           => $this->request->getPost('nik_ibu'),
            'file_akte_lahir'   => $dataFile['file_akte_lahir'] ?? null,
            'file_kk'           => $dataFile['file_kk'] ?? null,
            'file_ktp_ortu'     => $dataFile['file_ktp_ortu'] ?? null,
            'file_pas_foto'     => $dataFile['file_pas_foto'] ?? null,
            'status_pengajuan'  => 'Selesai'
        ];

        $insert = $this->kiaModel->insert($data);
        $lastId = $this->kiaModel->getInsertID();

        if ($insert) {
            // Generate PDF
            $pengajuan = $this->kiaModel->find($lastId);
            $pdfData = [
                'nomor_kia'        => 'KIA-' . str_pad($lastId, 6, '0', STR_PAD_LEFT),
                'nama_anak'        => $pengajuan['nama_anak'],
                'nik_anak'         => $pengajuan['nik_anak'],
                'tempat_lahir'     => $pengajuan['tempat_lahir'],
                'tanggal_lahir'    => $pengajuan['tanggal_lahir'],
                'jenis_kelamin'    => $pengajuan['jenis_kelamin'],
                'agama'            => $pengajuan['agama'],
                'alamat'           => $pengajuan['alamat'],
                'nama_ayah'        => $pengajuan['nama_ayah'],
                'nik_ayah'         => $pengajuan['nik_ayah'],
                'nama_ibu'         => $pengajuan['nama_ibu'],
                'nik_ibu'          => $pengajuan['nik_ibu'],
                'tanggal_pengajuan'=> date('Y-m-d'),
            ];
            $html = view('pdf/kartuIdentitasAnak_pdf', $pdfData);

            $dompdf = new \Dompdf\Dompdf();
            $dompdf->loadHtml($html);
            $dompdf->setPaper('A4', 'portrait');
            $dompdf->render();

            $pdfName = 'kia-' . $lastId . '-' . time() . '.pdf';
            file_put_contents($path . $pdfName, $dompdf->output());

            $this->kiaModel->update($lastId, [
                'file_pdf' => 'uploads/kia/' . $pdfName
            ]);

            return $this->response->setJSON([
                'status' => 'success',
                'message' => "Pengajuan berhasil disimpan! File KIA digital bisa diunduh dari riwayat.",
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
        $riwayat = $this->kiaModel
            ->where('user_id', $userId)
            ->orderBy('id', 'DESC')
            ->findAll();

        return view('home/Form/KIA/riwayat', [
            'title'   => 'Riwayat Pengajuan KIA',
            'riwayat' => $riwayat
        ]);
    }

    public function downloadKia($id)
    {
        $pengajuan = $this->kiaModel->find($id);

        if (!$pengajuan || $pengajuan['user_id'] != session('user.id')) {
            return redirect()->to('/')->with('error', 'Akses ditolak');
        }

        $pdfPath = WRITEPATH . $pengajuan['file_pdf'];
        if (!file_exists($pdfPath)) {
            return redirect()->back()->with('error', 'File tidak ditemukan');
        }

        return $this->response
            ->setHeader('Content-Type', 'application/pdf')
            ->setHeader('Content-Disposition', 'attachment; filename="KIA-'.$pengajuan['id'].'.pdf"')
            ->setBody(file_get_contents($pdfPath));
    }
}
