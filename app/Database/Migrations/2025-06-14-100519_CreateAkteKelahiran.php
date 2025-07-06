<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateAkteKelahiran extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id'              => ['type' => 'INT', 'constraint' => 11, 'auto_increment' => true],
            'nama_lengkap'    => ['type' => 'VARCHAR', 'constraint' => 128],
            'tempat_lahir'    => ['type' => 'VARCHAR', 'constraint' => 64],
            'tanggal_lahir'   => ['type' => 'DATE'],
            'jenis_kelamin'   => ['type' => 'VARCHAR', 'constraint' => 16],
            'agama'           => ['type' => 'VARCHAR', 'constraint' => 32],
            'nama_ayah'       => ['type' => 'VARCHAR', 'constraint' => 128],
            'nama_ibu'        => ['type' => 'VARCHAR', 'constraint' => 128],
            'alamat'          => ['type' => 'TEXT'],
            'rt'              => ['type' => 'VARCHAR', 'constraint' => 4],
            'rw'              => ['type' => 'VARCHAR', 'constraint' => 4],
            'kelurahan'       => ['type' => 'VARCHAR', 'constraint' => 64],
            'kecamatan'       => ['type' => 'VARCHAR', 'constraint' => 64],
            'created_at'      => ['type' => 'DATETIME', 'null' => true],
            'updated_at'      => ['type' => 'DATETIME', 'null' => true],
        ]);
        $this->forge->addKey('id', true);
        $this->forge->createTable('akte_kelahiran');
    }

    public function down()
    {
        $this->forge->dropTable('akte_kelahiran');
    }
}
