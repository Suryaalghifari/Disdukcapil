<?php
namespace App\Models;

use CodeIgniter\Model;

class KeteranganPindahModel extends Model
{
    protected $table      = 'keterangan_pindah';
    protected $primaryKey = 'id';

    protected $allowedFields = [
        'user_id',
        'nama_pemohon',
        'nik_pemohon',
        'alamat_asal',
        'rt_asal',
        'rw_asal',
        'kelurahan_asal',
        'kecamatan_asal',
        'kabupaten_asal',
        'provinsi_asal',
        'alamat_tujuan',
        'rt_tujuan',
        'rw_tujuan',
        'kelurahan_tujuan',
        'kecamatan_tujuan',
        'kabupaten_tujuan',
        'provinsi_tujuan',
        'alasan_pindah',
        'jumlah_anggota_pindah',
        'file_kk',
        'file_ktp',
        'file_pengantar_rt',
        'file_pdf',
        'status_pengajuan',
        'created_at', 'updated_at'
    ];

    protected $useTimestamps = true;
}
