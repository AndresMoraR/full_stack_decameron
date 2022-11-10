<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\ExcepcionModel;
use App\Models\FuncionarioModel;
use CodeIgniter\API\ResponseTrait;
use CodeIgniter\HTTP\ResponseInterface;

class Funcionario extends BaseController
{
	use ResponseTrait;
	public function index()
	{
		$excepcionModel = new ExcepcionModel();
		try {
			$funcionarioModel = new FuncionarioModel();
			$message = 'Consulta de todos los funcionarios correctamente';
			$codigo = ResponseInterface::HTTP_OK;

			$excepcionModel->save([
				'descripcion' => $message,
				'codigo' => $codigo,
				'fecha_generacion' => date('Y-m-d')
			]);

			return $this->getResponse([
				'message' => $message,
				'funcionarios' => $funcionarioModel->findAll()
			], $codigo);

		} catch (\Exception $e) {
			$excepcionModel->save([
				'descripción' => 'Consulta de datos fallida',
				'codigo' => ResponseInterface::HTTP_INTERNAL_SERVER_ERROR,
				'fecha_generacion' => date('Y-m-d')
			]);
			return $this->getResponse([
				'message' => 'Consulta de datos fallida'
			], ResponseInterface::HTTP_INTERNAL_SERVER_ERROR);
		}
		
	}

	public function store()
	{
		$excepcionModel = new ExcepcionModel();
		try {
			$rules = [
				'nombre' => 'required|min_length[3]|max_length[15]|alpha',
				'apellido' => 'min_length[3]|max_length[15]|alpha',
				'telefono' => 'max_length[10]|numeric',
				'identificacion' => 'required|max_length[12]',
				'fecha_nacimiento' => 'valid_date[Y-m-d]|ValidateRange[fecha_nacimiento]'
			];

			$errors = [
				'fecha_nacimiento' => [
					'ValidateRange' => 'The fecha_nacimiento contains a Invalid year'
				]
			];
						
			$input = $this->getRequestInput($this->request);
			$funcionario_id = $input['identificacion']; 
			if (!$this->validateRequest($input, $rules, $errors)) {
				$excepcionModel->save([
					'descripcion' => json_encode($this->validator->getErrors()),
					'codigo' => ResponseInterface::HTTP_BAD_REQUEST,
					'fecha_generacion' => date('Y-m-d')
				]);
				return $this->getResponse($this->validator->getErrors(), ResponseInterface::HTTP_BAD_REQUEST);
			}

			$message = 'Funcionario creado correctamente';
			$codigo = ResponseInterface::HTTP_OK;
			$funcionarioModel = new FuncionarioModel();
			$funcionarioModel->save($input);	
			$funcionario = $funcionarioModel->where('identificacion', $funcionario_id)->first();
			$excepcionModel->save([
				'descripcion' => $message,
				'codigo' => $codigo,
				'fecha_generacion' => date('Y-m-d')
			]);
			return $this->getResponse([
				'message' => $message,
				'funcionario' => $funcionario
			], $codigo);
		} catch (\Exception $e) {
			$excepcionModel->save([
				'descripción' => 'Registro de datos fallida',
				'codigo' => ResponseInterface::HTTP_INTERNAL_SERVER_ERROR,
				'fecha_generacion' => date('Y-m-d')
			]);
			return $this->getResponse([
				'message' => 'Registro de datos fallida: '.$e
			], ResponseInterface::HTTP_INTERNAL_SERVER_ERROR);
		}
		
	}
}
