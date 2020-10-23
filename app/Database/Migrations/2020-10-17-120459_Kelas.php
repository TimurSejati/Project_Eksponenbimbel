<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Kelas extends Migration
{
	public function up()
	{
		$this->forge->addField([
			'id'          => [
				'type'           => 'INT',
				'constraint'     => 5,
				'unsigned'       => true,
				'auto_increment' => true,
			],
			'kategori_id'       => [
				'type'           => 'INT',
				'constraint'     => 5,
				'unsigned'       => true,
			],
			'kelas'       => [
				'type'           => 'VARCHAR',
				'constraint'     => '50',
			],

		]);
		$this->forge->addKey('id', true);
		$this->forge->createTable('kelas');
	}

	//--------------------------------------------------------------------

	public function down()
	{
		$this->forge->dropTable('kelas');
	}
}
