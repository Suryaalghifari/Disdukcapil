<?php

namespace App\Models;

use CodeIgniter\Model;

class AkteKelahiranModel extends Model
{
    protected $table      = 'akte_kelahiran';
    protected $primaryKey = 'id';
    protected $allowedFields = [
        'user_id','nama_lengkap','tempat_lahir','tanggal_lahir','jenis_kelamin','agama',
        'nama_ayah','nik_ayah','nama_ibu','nik_ibu','alamat','kelurahan','kecamatan',
        'tempat_perkawinan','tanggal_perkawinan','file_kk','file_surat_lahir','file_ktp_ortu',
        'status_pengajuan','file_pdf','created_at','updated_at'
    ];
    protected $useTimestamps = true;
}
