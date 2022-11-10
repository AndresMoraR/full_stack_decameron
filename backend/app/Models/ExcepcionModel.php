<?php

namespace App\Models;

use CodeIgniter\Model;
use DateTime;

class ExcepcionModel extends Model
{
    protected $DBGroup = 'excepcion';
    protected $table = 'prb_excepcion';
    protected $allowedFields = [
        'descripcion', 'codigo', 'fecha_generacion'
    ];
    protected $updateField = 'updated_at';

    public function findFuncionarioByDate(string $fecha1, string $fecha2)
    {
        $db = db_connect('excepcion');
        $query = 'SELECT id, descripcion, codigo, fecha_generacion FROM prb_excepcion WHERE fecha_generacion >= ? and fecha_generacion <= ? ';
        $excepciones = $db->query($query, [$fecha1, $fecha2])->getResult();            
        return $excepciones;
    }
}