<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Nilai extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id_nilai' => [
                'type' => 'INT',
                'constraint' => 11,
                'unsigned' => true,
                'auto_increment' => true
            ],
            'id_mata_kuliah' => [
                'type' => 'INT',
                'constraint' => 11,
                'unsigned' => true,
            ],
            'id_mahasiswa' => [
                'type' => 'INT',
                'constraint' => 11,
                'unsigned' => true,
            ],
            'nilai_uts' => [
                'type' => 'FLOAT',
            ],
            'nilai_uas' => [
                'type' => 'FLOAT',
            ],
        ]);
        $this->forge->addPrimaryKey('id_nilai');
        $this->forge->addForeignKey('id_mata_kuliah', 'mata_kuliah', 'id_mata_kuliah', 'CASCADE', 'CASCADE');
        $this->forge->addForeignKey('id_mahasiswa', 'mahasiswa', 'id_mahasiswa', 'CASCADE', 'CASCADE');
        $this->forge->createTable('niai');
    }

    public function down()
    {
        $this->forge->dropTable('nilai');
    }
}
