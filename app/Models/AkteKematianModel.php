<?php
namespace App\Models;

use CodeIgniter\Model;

class AkteKematianModel extends Model
{
    protected $table      = 'akte_kematian'; // Nama tabel di database
    protected $primaryKey = 'id';

    protected $allowedFields = [
        'user_id',
        'nama_meninggal',
        'nik_meninggal',
        'tempat_meninggal',
        'tanggal_meninggal',
        'jenis_kelamin',
        'agama',
        'alamat',
        'penyebab_kematian',
        'nama_pelapor',
        'nik_pelapor',
        'hubungan_pelapor',
        'file_kk',
        'file_ktp_pelapor',
        'file_surat_kematian',
        'file_pdf',
        'status_pengajuan',
        'created_at', 'updated_at'
    ];

    protected $useTimestamps = true;
}
