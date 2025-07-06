<?php
namespace App\Models;

use CodeIgniter\Model;

class KartuKeluargaModel extends Model
{
    protected $table      = 'kartu_keluarga'; // Nama tabel di database
    protected $primaryKey = 'id';

    protected $allowedFields = [
        'user_id',
        'nama_kepala_keluarga',
        'nik_kepala_keluarga',
        'alamat',
        'rt',
        'rw',
        'kelurahan',
        'kecamatan',
        'kode_pos',
        'file_ktp_kepala',
        'file_pengantar_rt',
        'file_lampiran_kk_lama',
        'file_pdf',
        'status_pengajuan',
        'created_at',
        'updated_at'
    ];

    protected $useTimestamps = true;
}
