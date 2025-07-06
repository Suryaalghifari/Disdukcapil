<?php
namespace App\Models;

use CodeIgniter\Model;

class AktePerkawinanModel extends Model
{
    protected $table      = 'akte_perkawinan';
    protected $primaryKey = 'id';

    protected $allowedFields = [
        'user_id',
        'nama_suami',
        'nik_suami',
        'tempat_lahir_suami',
        'tanggal_lahir_suami',
        'agama_suami',
        'alamat_suami',
        'nama_istri',
        'nik_istri',
        'tempat_lahir_istri',
        'tanggal_lahir_istri',
        'agama_istri',
        'alamat_istri',
        'tanggal_perkawinan',
        'tempat_perkawinan',
        'file_ktp_suami',
        'file_ktp_istri',
        'file_kk',
        'file_buku_nikah',
        'file_surat_perkawinan',
        'file_pdf',
        'status_pengajuan',
        'created_at', 'updated_at'
    ];

    protected $useTimestamps = true;
}
