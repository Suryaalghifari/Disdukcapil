<?php
namespace App\Models;

use CodeIgniter\Model;

class KartuIdentitasAnakModel extends Model
{
    protected $table      = 'kartu_identitas_anak';
    protected $primaryKey = 'id';

    protected $allowedFields = [
        'user_id',
        'nama_anak',
        'nik_anak',
        'tempat_lahir',
        'tanggal_lahir',
        'jenis_kelamin',
        'agama',
        'alamat',
        'nama_ayah',
        'nik_ayah',
        'nama_ibu',
        'nik_ibu',
        'file_akte_lahir',
        'file_kk',
        'file_ktp_ortu',
        'file_pas_foto',
        'file_pdf',
        'status_pengajuan',
        'created_at','updated_at'
    ];

    protected $useTimestamps = true;
}
