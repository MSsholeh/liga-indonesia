<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;
use CodeIgniter\Database\RawSql;

class Clubs extends Migration
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
			'name'       => [
				'type'           => 'VARCHAR',
				'constraint'     => '100'
			],
            'photo'      => [
				'type'           => 'VARCHAR',
				'constraint'     => '255',
                'null'           => true
			],
            'slug'      => [
				'type'           => 'VARCHAR',
				'constraint'     => '255',
                'unique'         => true,
                'null'           => false
			],
			'created_at datetime default current_timestamp',
            'updated_at datetime default current_timestamp on update current_timestamp',
            'deleted_at datetime',
		]);

        $this->forge->addKey('id', true);
		$this->forge->createTable('clubs', TRUE);
    }

    public function down()
    {
        $this->forge->dropTable('clubs');
    }
}
