<?php

namespace App\Filters;

use CodeIgniter\API\ResponseTrait;
use CodeIgniter\Filters\FilterInterface;
use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
use CodeIgniter\Config\Services;
use App\Models\ExcepcionModel;

class JwtauthenticationFilter implements FilterInterface
{
	use ResponseTrait;
	/**
	 * Do whatever processing this filter needs to do.
	 * By default it should not return anything during
	 * normal execution. However, when an abnormal state
	 * is found, it should return an instance of
	 * CodeIgniter\HTTP\Response. If it does, script
	 * execution will end and that Response will be
	 * sent back to the client, allowing for error pages,
	 * redirects, etc.
	 *
	 * @param RequestInterface $request
	 * @param array|null       $arguments
	 *
	 * @return mixed
	 */
	public function before(RequestInterface $request, $arguments = null)
	{
		$authentication_header = $request->getServer('HTTP_AUTHORIZATION');
		$excepcionModel = new ExcepcionModel();
		try {
			helper('jwt');
			$encodeToken = getJWTFromRequest($authentication_header);
			validateJWTfromRequest($encodeToken);
			$excepcionModel->save([
				'descripcion' => 'JWT Validado correctamente',
				'codigo' => ResponseInterface::HTTP_OK,
				'fecha_generacion' => date('Y-m-d')
			]);
			return $request;
		} catch (\Exception $e) {
			$excepcionModel->save([
				'descripcion' => $e->getMessage(),
				'codigo' => ResponseInterface::HTTP_BAD_REQUEST,
				'fecha_generacion' => date('Y-m-d')
			]);
			return Services::response()
				->setJSON([
					'error' => $e->getMessage()
				])->setStatusCode(ResponseInterface::HTTP_UNAUTHORIZED);
		}
	}

	/**
	 * Allows After filters to inspect and modify the response
	 * object as needed. This method does not allow any way
	 * to stop execution of other after filters, short of
	 * throwing an Exception or Error.
	 *
	 * @param RequestInterface  $request
	 * @param ResponseInterface $response
	 * @param array|null        $arguments
	 *
	 * @return mixed
	 */
	public function after(RequestInterface $request, ResponseInterface $response, $arguments = null)
	{
		//
	}
}
