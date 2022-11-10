<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AddFuncionario extends Migration
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
            'nombre' => [
                'type' => 'VARCHAR',
                'constraint' => '15',
                'null' => false
            ],
            'apellido' => [
                'type' => 'VARCHAR',
                'constraint' => '15',
                'null' => true,
            ],
            'telefono' => [
                'type' => 'INT',
                'constraint' => '10',
                'null' => true,
            ],
			'identificacion' => [
                'type' => 'VARCHAR',
                'constraint' => '12',
                'null' => false,
            ],
			'fecha_nacimiento' => [
                'type' => 'date',
                'null' => true,
            ],
            'updated_at' => [
                'type' => 'datetime',
                'null' => true,
            ],
            'created_at datetime default current_timestamp',
        ]);
        $this->forge->addPrimaryKey('id');
        $this->forge->createTable('prb_funcionario');
	}

	public function down()
	{
		$this->forge->dropTable('prb_funcionario');
	}
}
