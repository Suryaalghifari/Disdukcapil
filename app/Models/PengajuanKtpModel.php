<?php
namespace App\Models;

use CodeIgniter\Model;

class PengajuanKtpModel extends Model
{
    protected $table      = 'pengajuan_ktp';
    protected $primaryKey = 'id';
    protected $allowedFields = [
        'user_id','nik','nama_lengkap','tempat_lahir','tanggal_lahir','jenis_kelamin',
        'agama','status_perkawinan','pekerjaan','alamat','rt','rw','kelurahan','kecamatan',
        'file_kk','file_akta','file_nikah','file_foto','status_pengajuan','file_pdf',
    ];
    protected $useTimestamps = true;
}
