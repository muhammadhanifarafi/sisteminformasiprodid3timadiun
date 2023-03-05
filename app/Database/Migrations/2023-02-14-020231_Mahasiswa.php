<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Mahasiswa extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id_mahasiswa' => [
                'type' => 'INT',
                'constraint' => 11,
                'unsigned' => true,
                'auto_increment' => true
            ],
            'nim' => [
                'type' => 'VARCHAR',
                'constraint' => 255
            ],
            'nama' => [
                'type' => 'VARCHAR',
                'constraint' => 255
            ],
            'kelas' => [
                'type' => 'VARCHAR',
                'constraint' => 255
            ],
            'ttl' => [
                'type' => 'DATE'
            ],
            'no_telp' => [
                'type' => 'VARCHAR',
                'constraint' => 255
            ],
            'angkatan' => [
                'type' => 'INT',
                'constraint' => 255
            ],
            'alamat' => [
                'type' => 'TEXT'
            ],
            'status' => [
                'type' => 'TINYINT',
                'constraint' => 1,
                'default' => 1
            ],
        ]);
        $this->forge->addPrimaryKey('id_mahasiswa');
        $this->forge->createTable('mahasiswa');
    }

    public function down()
    {
        $this->forge->dropTable('mahasiswa');
    }
}