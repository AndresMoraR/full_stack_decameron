<?php

namespace App\Models;

use CodeIgniter\Model;

class FuncionarioModel extends Model
{
    protected $table = 'prb_funcionario';
    protected $allowedFields = [
        'nombre', 'apellido', 'telefono', 'identificacion', 'fecha_nacimiento'
    ];
    protected $updateField = 'updated_at';
    
    public function findFuncionarioById(string $identificacion)
    {
        $funcionario = $this->asArray()->where(['identificacion'=>$identificacion])->first();
        if (!$funcionario) {
            throw new \Exception('No existen funcionarios creados.');
        }
        return $funcionario;
    }
}