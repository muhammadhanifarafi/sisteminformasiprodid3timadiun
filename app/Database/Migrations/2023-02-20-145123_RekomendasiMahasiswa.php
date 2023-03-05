<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class RekomendasiMahasiswa extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id_rekomendasi_mahasiswa' => [
                'type' => 'INT',
                'constraint' => 11,
                'unsigned' => true,
                'auto_increment' => true
            ],
            // 'id_mahasiswa' => [
            //     'type' => 'INT',
            //     'constraint' => 11,
            //     'unsigned' => true,
            // ],
            // 'id_user' => [
            //     'type' => 'INT',
            //     'constraint' => 11,
            //     'unsigned' => true,
            // ],
            // 'id_sub_bidang' => [
            //     'type' => 'INT',
            //     'constraint' => 11,
            //     'unsigned' => true,
            // ],
        ]);

        $this->forge->addPrimaryKey('id_rekomendasi_mahasiswa');
        // $this->forge->addForeignKey('id_mahasiswa', 'mahasiswa', 'id_mahasiswa');
        // $this->forge->addForeignKey('id_user', 'user', 'id_user');
        // $this->forge->addForeignKey('id_sub_bidang', 'sub_bidang', 'id_sub_bidang');
        $this->forge->createTable('rekomendasi_mahasiswa');
    }

    public function down()
    {
        $this->forge->dropTable('rekomendasi_mahasiswa');
    }
}
