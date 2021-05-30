<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Materi extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id' => [
                'type' => 'INT',
                'constraint' => 5,
                'unsigned' => true,
                'auto_increment' => true,
            ],
            'judul_materi' => [
                'type' => 'VARCHAR',
                'constraint' => 250,
            ],
            'slug' => [
                'type' => 'VARCHAR',
                'constraint' => 250,
            ],
            'prolog_materi' => [
                'type' => 'TEXT',
            ],
            'artikel_materi' => [
                'type' => 'TEXT',
            ],
            'kategori_id' => [
                'type' => 'INT',
                'constraint' => 5,
                'unsigned' => true,
            ],
            'kelas_id' => [
                'type' => 'INT',
                'constraint' => 5,
                'unsigned' => true,
            ],
            'gambar' => [
                'type' => 'VARCHAR',
                'constraint' => 255,
            ],
            'file' => [
                'type' => 'VARCHAR',
                'constraint' => 255,
            ],

        ]);
        $this->forge->addKey('id', true);
        $this->forge->createTable('materi');
    }

    //--------------------------------------------------------------------

    public function down()
    {
        $this->forge->dropTable('materi');
    }
}
