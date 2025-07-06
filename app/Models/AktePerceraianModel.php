<?php
namespace App\Models;

use CodeIgniter\Model;

class AktePerceraianModel extends Model
{
    protected $table      = 'akte_perceraian';
    protected $primaryKey = 'id';

    protected $allowedFields = [
        'user_id',
        'nama_suami',
        'nik_suami',
        'nama_istri',
        'nik_istri',
        'nomor_perkawinan',
        'tanggal_perkawinan',
        'tempat_perkawinan',
        'tanggal_perceraian',
        'tempat_perceraian',
        'penyebab_perceraian',
        'file_ktp_suami',
        'file_ktp_istri',
        'file_akte_perkawinan',
        'file_putusan_pengadilan',
        'file_kk',
        'file_pdf',
        'status_pengajuan',
        'created_at', 'updated_at'
    ];

    protected $useTimestamps = true;
}
