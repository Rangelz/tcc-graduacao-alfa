<?php

namespace App\Handler;

require '../../vendor/autoload.php';

use App\Entity\Categorias;
use App\Service\categoria\CategoriaService;
use App\Util\ValidarCampos;
use Exception;

try {
    session_start();

    $validar = new ValidarCampos();

    $id_categoria = $validar->validarCampo($_POST["id_categoria"], 'Identificação');

    $categoria = new categorias();

    $categoria->setId_categoria($id_categoria);

    $categoriaService = new categoriaService();

    if ($categoriaService->excluir($categoria)) {
        echo "categoria excluído com sucesso!";
        exit;
    }

    throw new Exception("Erro ao excluir categoria");

} catch (Exception $e) {
    $message = $e->getMessage();
    echo $message;
    exit;
}
