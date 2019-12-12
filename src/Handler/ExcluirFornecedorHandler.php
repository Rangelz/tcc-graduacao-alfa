<?php

namespace App\Handler;

require '../../vendor/autoload.php';

use App\Entity\Fornecedores;
use App\Service\Fornecedor\FornecedorService;
use App\Util\ValidarCampos;
use Exception;

try {
    session_start();

    $validar = new ValidarCampos();

    $id_fornecedor = $validar->validarCampo($_POST["id_fornecedor"], 'Identificação');

    $fornecedor = new Fornecedores();

    $fornecedor->setId_fornecedor($id_fornecedor);

    $fornecedorService = new FornecedorService();

    if ($fornecedorService->excluir($fornecedor)) {
        echo "Fornecedor excluído com sucesso!";
        exit;
    }

    throw new Exception("Erro ao excluir usuário");

} catch (Exception $e) {
    $message = $e->getMessage();
    echo $message;
    exit;
}
