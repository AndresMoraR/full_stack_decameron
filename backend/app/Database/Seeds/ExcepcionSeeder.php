<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;
use Faker\Factory;

class ExcepcionSeeder extends Seeder
{
	protected $DBGroup = 'excepcion';
	public function run()
	{
		$this->db->table('prb_excepcion')->insert($this->generarExcepcion());
	}

	private function generarExcepcion()
	{
		$faker = Factory::create();

		return [
			'descripcion' => 'Expcecion generada por seeder correctamente',
			'codigo' => '200',
			'fecha_generacion' => date('Y-m-d')
		];
	}
}
