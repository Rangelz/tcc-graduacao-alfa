<?php

namespace App\Handler;

require '../../vendor/autoload.php';

use App\Entity\categorias;
use App\Service\categoria\categoriaService;
use App\Util\ValidarCampos;
use Exception;

try {
    $validar = new ValidarCampos();

    $categoria  = new categorias;
    
    if ($_POST["id_categoria"]) {
        $id = $validar->validarCampo($_POST["id_categoria"], 'id_categoria');
        $categoria->setId_categoria($id);
    }

    $nome = $validar->validarCampo($_POST["nome"], 'Nome');

    $categoria->setNome_Categoria($nome);

    $categoriaService = new categoriaService();

    if (isset($id)) {
        if ($categoriaService->editar($categoria)) {
            echo "categoria editada com sucesso!";
            exit;
        } else {
            throw new Exception("Erro ao editar categoria!", 500);
            exit;
        }
    } else {
        if ($categoriaService->inserir($categoria)) {
            echo "categoria incluída com sucesso!";
            exit;
        } else {
            throw new Exception("Erro ao incluir categoria!", 500);
            exit;
        }
    }


} catch (Exception $e) {
    $message = $e->getMessage();
    echo $message;
    exit;
}
