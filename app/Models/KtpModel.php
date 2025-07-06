<?php

namespace App\Models;

use CodeIgniter\Model;

class KtpModel extends Model
{
    protected $table      = 'pengajuan_ktp';   // Nama tabel di database
    protected $primaryKey = 'id';

    protected $allowedFields = [
        'nik',
        'nama_lengkap', // Ganti dari 'nama'
        'tempat_lahir',
        'tanggal_lahir',
        'jenis_kelamin',
        'alamat',
        'rt',
        'rw',
        'kelurahan',
        'kecamatan',
        'agama',
        'status_perkawinan',
        'pekerjaan',
        'gol_darah',
        // Tambahkan field lain sesuai tabelmu
        'file_kk',
        'file_akta',
        'file_nikah',
        'file_foto',
        'user_id',
        'status_pengajuan',
        'created_at', 'updated_at'
    ];

    // Jika pakai created_at/updated_at otomatis
    protected $useTimestamps = true;

    // Optional: jika kamu ingin validasi di model
    protected $validationRules = [
        'nik' => 'required|exact_length[16]|numeric',
        'nama_lengkap' => 'required', // Ganti dari 'nama'
        'tanggal_lahir' => 'required|valid_date',
        // dst...
    ];
}
