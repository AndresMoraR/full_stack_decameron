<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;
use Faker\Factory;

class FuncionarioSeeder extends Seeder
{
	public function run()
	{
		for ($i=0; $i < 5; $i++) { 
			$this->db->table('prb_funcionario')->insert($this->generarFuncionario());
		}
	}

	private function generarFuncionario()
	{
		$faker = Factory::create();

		return [
			'nombre' => $faker->name,
			'apellido' => $faker->lastName(),
			'telefono' => $faker->phoneNumber,
			'identificacion' => random_int(1000000,10000000000),
			'fecha_nacimiento' => $faker->dateTimeThisCentury->format('Y-m-d')
		];
	}
}
