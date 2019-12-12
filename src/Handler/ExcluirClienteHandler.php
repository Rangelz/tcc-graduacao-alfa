<?php

namespace App\Handler;

require '../../vendor/autoload.php';

use App\Entity\Clientes;
use App\Service\Cliente\ClienteService;
use App\Util\ValidarCampos;
use Exception;

try {
    session_start();

    $validar = new ValidarCampos();

    $id_cliente = $validar->validarCampo($_POST["id_cliente"], 'Identificação');

    $cliente = new Clientes();

    $cliente->setId_cliente($id_cliente);

    $ClienteService = new ClienteService();

    if ($ClienteService->excluir($cliente)) {
        echo "Cliente excluído com sucesso!";
        exit;
    }

    throw new Exception("Erro ao excluir cliente");

} catch (Exception $e) {
    $message = $e->getMessage();
    echo $message;
    exit;
}
