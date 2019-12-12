<?php

declare(strict_types=1);

namespace App\Util;

use Exception;

class ValidarCampos
{
    public function validarCampo($campo, $nome = null)
    {
        if (isset($campo)) {
            $campo = trim($campo);

            if (empty($campo)) {
                throw new Exception("O campo $nome está vazio!");
            }
            return $campo;
        }

        throw new Exception("parametro $nome não encontrado na requisição!");

    }
}