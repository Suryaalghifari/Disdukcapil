<?php
namespace App\Models;

use CodeIgniter\Model;

class AkteKelahiranModel extends Model
{
    protected $table      = 'akte_kelahiran'; // nama tabel utama
    protected $primaryKey = 'id';

    protected $allowedFields = [
        'user_id',
        'nama_lengkap',
        'tempat_lahir',
        'tanggal_lahir',
        'jenis_kelamin',
        'agama',
        'alamat',
        'nama_ayah',
        'nik_ayah',
        'nama_ibu',
        'nik_ibu',
        'kelurahan',
        'kecamatan',
        'tempat_perkawinan',
        'tanggal_perkawinan',
        'file_kk',
        'file_surat_lahir',
        'file_ktp_ortu',
        'file_pdf',
        'status_pengajuan',
        'created_at', 'updated_at'
    ];
    

    protected $useTimestamps = true;
}
