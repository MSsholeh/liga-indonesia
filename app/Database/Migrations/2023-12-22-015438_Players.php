<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;
use CodeIgniter\Database\RawSql;

class Players extends Migration
{
    public function up()
    {
        $this->forge->addField([
			'id'          => [
				'type'           => 'INT',
				'constraint'     => 5,
				'unsigned'       => true,
				'auto_increment' => true
			],
            'club_id'     => [
				'type'           => 'INT',
				'constraint'     => 5
			],
			'name'       => [
				'type'           => 'VARCHAR',
				'constraint'     => '100'
			],
            'photo'      => [
				'type'           => 'VARCHAR',
				'constraint'     => '255'
			],
            'birth_date' => [
                'type'           => 'DATETIME',
                'null'           => false
            ],
            'back_number'     => [
				'type'           => 'INT',
				'constraint'     => 2
			],
            'position'      => [
				'type'           => 'VARCHAR',
				'constraint'     => '100'
			],
            'country'      => [
				'type'           => 'VARCHAR',
				'constraint'     => '100'
			],
            'slug'      => [
				'type'           => 'VARCHAR',
				'constraint'     => '255',
                'unique'         => true,
                'null'           => false
			],
			'created_at datetime default current_timestamp',
            'updated_at datetime default current_timestamp on update current_timestamp',
            'deleted_at datetime'
		]);

		$this->forge->addKey('id', true);
		$this->forge->createTable('palyers', TRUE);
        $this->forge->addForeignKey('club_id', 'clubs', 'id');
    }

    public function down()
    {
        $this->forge->dropTable('palyers');
    }
}
