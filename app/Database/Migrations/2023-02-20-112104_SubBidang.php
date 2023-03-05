<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class SubBidang extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id_sub_bidang' => [
                'type' => 'INT',
                'constraint' => 11,
                'unsigned' => true,
                'auto_increment' => true
            ],
            'id_bidang' => [
                'type' => 'INT',
                'constraint' => 11,
                'unsigned' => true,
            ],
            'nama_sub_bidang' => [
                'type' => 'VARCHAR',
                'constraint' => 255
            ],
        ]);
        $this->forge->addPrimaryKey('id_sub_bidang');
        $this->forge->addForeignKey('id_bidang', 'bidang', 'id_bidang', 'CASCADE', 'CASCADE');
        $this->forge->createTable('sub_bidang');
    }

    public function down()
    {
        $this->forge->dropTable('sub_bidang');
    }
}
