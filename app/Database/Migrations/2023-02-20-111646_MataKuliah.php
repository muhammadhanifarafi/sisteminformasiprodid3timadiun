<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class MataKuliah extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id_mata_kuliah' => [
                'type' => 'INT',
                'constraint' => 11,
                'unsigned' => true,
                'auto_increment' => true
            ],
            'kode_mata_kuliah' => [
                'type' => 'VARCHAR',
                'constraint' => 255
            ],
            'nama_mata_kuliah' => [
                'type' => 'VARCHAR',
                'constraint' => 255
            ],
        ]);
        $this->forge->addPrimaryKey('id_mata_kuliah');
        $this->forge->createTable('mata_kuliah');
    }

    public function down()
    {
        $this->forge->dropTable('mata_kuliah');
    }
}
