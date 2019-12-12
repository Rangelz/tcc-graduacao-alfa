<?php

namespace App\Handler;

require '../../vendor/autoload.php';

use App\Entity\Usuarios;
use App\Service\Usuario\UsuarioService;
use App\Util\ValidarCampos;
use Exception;

try {
    session_start();

    $validar = new ValidarCampos();

    $id= $validar->validarCampo($_POST["id"], 'Identificação');

    $usuario = new Usuarios();

    $usuario->setId($id);

    $UsuarioService = new UsuarioService();

    if ($UsuarioService->excluir($usuario)) {
        echo "Usuario excluído com sucesso!";
        exit;
    }

    throw new Exception("Erro ao excluir Usuario");

} catch (Exception $e) {
    $message = $e->getMessage();
    echo $message;
    exit;
}
