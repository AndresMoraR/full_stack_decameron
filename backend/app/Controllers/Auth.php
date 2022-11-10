<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;

class Auth extends BaseController
{
	public function generate()
	{
		return $this->getJWTForFuncionario(ResponseInterface::HTTP_CREATED);
	}

	private function getJWTForFuncionario(int $response_code)
	{
		$response_code = ResponseInterface::HTTP_OK;
		try {			
			helper('jwt');
			return $this->getResponse([
				'message' => 'Autenticación correcta',
				'access_token' => getSignedJWTForUser()
			], $response_code);
		} catch (\Exception $e) {
			return $this->getResponse([
				'error' => $e->getMessage()
			], $response_code);
		}
	}
}
