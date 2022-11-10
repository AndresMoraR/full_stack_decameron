<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\ExcepcionModel;
use CodeIgniter\API\ResponseTrait;
use CodeIgniter\HTTP\ResponseInterface;
use DateTime;
use PHPUnit\Framework\Constraint\IsEmpty;

class Excepcion extends BaseController
{
	use ResponseTrait;

	public function index()
	{
		$excepcionModel = new ExcepcionModel();
		return $this->getResponse([
				'message' => 'Consulta de todos las expceciones correctamente',
				'excepciones' => $excepcionModel->findAll()
			], ResponseInterface::HTTP_OK);
	}

	public function filterDate()
	{
		$excepcionModel = new ExcepcionModel();
		$input = $this->getRequestInput($this->request);
		$fecha1 = date('Y-m-d', strtotime($input['fecha_1']));
		$fecha2 = date('Y-m-d', strtotime($input['fecha_2']));
		$rules = [
			'fecha_1' => 'valid_date[Y-m-d]',
			'fecha_2' => 'valid_date[Y-m-d]',
		];
		if (!$this->validateRequest($input, $rules)) {
			return $this->getResponse($this->validator->getErrors(), ResponseInterface::HTTP_BAD_REQUEST);
		}
		$response = $excepcionModel->findFuncionarioByDate($fecha1, $fecha2);
		return $this->getResponse([
			'message' => 'Consulta de todos las expceciones correctamente',
			'excepciones' => $response
		], ResponseInterface::HTTP_OK);
	}

	public function store()
	{
		$rules = [
			'descripcion' => 'required',
			'codigo' => 'required|max_length[3]|numeric',
			'fecha_generacion' => 'required|valid_date[Y-m-d]',
		];
		
		$input = $this->getRequestInput($this->request);
		if (!$this->validateRequest($input, $rules)) {
			return $this->getResponse($this->validator->getErrors(), ResponseInterface::HTTP_BAD_REQUEST);
		}

		$excepcionModel = new ExcepcionModel();
		$excepcionModel->save($input);	
        $excepcion_id = $excepcionModel->getInsertID();
        $excepcion = $excepcionModel->where('id', $excepcion_id)->first();
		return $this->getResponse([
			'message' => 'Excepcion creada correctamente',
			'excepcion' => $excepcion
		], ResponseInterface::HTTP_OK);
	}
}
