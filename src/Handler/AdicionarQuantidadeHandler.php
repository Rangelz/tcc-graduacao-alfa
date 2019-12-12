<?php

namespace App\Handler;

require '../../vendor/autoload.php';

use App\Entity\Produtos;
use App\Service\Produto\ProdutoService;
use App\Util\ValidarCampos;
use Exception;

try {
    $validar = new ValidarCampos();

    $id = $validar->validarCampo($_POST["id_produto"], 'id_produto');
    $quantidade = (int) $validar->validarCampo($_POST["quantidade"], 'Quantidade');
    $produtoService = new ProdutoService();

    if ($produtoService->aumentarEstoque($id, $quantidade)) {
        echo "Quantidade adicionada com sucesso!";
        exit;
    } else {
        throw new Exception("Erro ao editar produto produto!", 500);
        exit;
    }

} catch (Exception $e) {
    $message = $e->getMessage();
    echo $message;
    exit;
}
