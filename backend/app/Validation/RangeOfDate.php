<?php

namespace App\Validation;

class RangeOfDate
{
	public function ValidateRange(string $str, string $fields, array $data)
	{
		try {
			$year = explode("-", $data['fecha_nacimiento']);
			if ($year[0] > '1922' && $year[0] < '2005') {
				return true;
			}else{
				return false;
			}
		} catch (\Exception $e) {
			return false;
		}
	}
}
