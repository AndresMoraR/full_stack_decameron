<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Addexception extends Migration
{
	protected $DBGroup = 'excepcion';
	public function up()
	{
		$this->forge->addField([
            'id' => [
                'type' => 'INT',
                'constraint' => 5,
                'unsigned' => true,
                'auto_increment' => true,
            ],
            'descripcion' => [
                'type' => 'TEXT',
                'null' => false
            ],
            'codigo' => [
                'type' => 'INT',
                'constraint' => '10',
                'null' => false,
            ],
			'fecha_generacion' => [
                'type' => 'date',
                'null' => false,
            ],
            'updated_at' => [
                'type' => 'datetime',
                'null' => true,
            ],
            'created_at datetime default current_timestamp',
        ]);
        $this->forge->addPrimaryKey('id');
        $this->forge->createTable('prb_excepcion');
	}

	public function down()
	{
		$this->forge->dropTable('prb_excepcion');
	}
}
