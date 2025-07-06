<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreatePengajuanKtpTable extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id'               => ['type' => 'INT', 'auto_increment' => true, 'unsigned' => true],
            'user_id'          => ['type' => 'INT', 'unsigned' => true, 'null' => true],
            'nik'              => ['type' => 'VARCHAR', 'constraint' => 16],
            'nama_lengkap'     => ['type' => 'VARCHAR', 'constraint' => 255],
            'tempat_lahir'     => ['type' => 'VARCHAR', 'constraint' => 100],
            'tanggal_lahir'    => ['type' => 'DATE'],
            'jenis_kelamin'    => ['type' => 'VARCHAR', 'constraint' => 10],
            'agama'            => ['type' => 'VARCHAR', 'constraint' => 50],
            'status_perkawinan'=> ['type' => 'VARCHAR', 'constraint' => 50],
            'pekerjaan'        => ['type' => 'VARCHAR', 'constraint' => 100],
            'alamat'           => ['type' => 'TEXT'],
            'rt'               => ['type' => 'VARCHAR', 'constraint' => 3],
            'rw'               => ['type' => 'VARCHAR', 'constraint' => 3],
            'kelurahan'        => ['type' => 'VARCHAR', 'constraint' => 100],
            'kecamatan'        => ['type' => 'VARCHAR', 'constraint' => 100],
            'file_kk'          => ['type' => 'VARCHAR', 'constraint' => 255, 'null' => true],
            'file_akta'        => ['type' => 'VARCHAR', 'constraint' => 255, 'null' => true],
            'file_nikah'       => ['type' => 'VARCHAR', 'constraint' => 255, 'null' => true],
            'file_foto'        => ['type' => 'VARCHAR', 'constraint' => 255, 'null' => true],
            'status_pengajuan' => ['type' => 'VARCHAR', 'constraint' => 20, 'default' => 'Proses'],
            'created_at'       => ['type' => 'DATETIME', 'null' => true],
            'updated_at'       => ['type' => 'DATETIME', 'null' => true],
        ]);
        $this->forge->addKey('id', true);
        $this->forge->createTable('pengajuan_ktp');
    }


    public function down()
    {
        //
    }
}
