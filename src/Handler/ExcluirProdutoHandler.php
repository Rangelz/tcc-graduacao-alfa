<?php

namespace App\Handler;

require '../../vendor/autoload.php';

use App\Entity\Produtos;
use App\Service\Produto\ProdutoService;
use App\Util\ValidarCampos;
use Exception;

try {
    session_start();

    $validar = new ValidarCampos();

    $id_produto = $validar->validarCampo($_POST["id_produto"], 'Identificação');

    $produto = new Produtos();

    $produto->setId_produto($id_produto);

    $produtoService = new ProdutoService();

    if ($produtoService->verificarSeProdutoJaFoiVendido($produto->getId_produto())) {
        echo "O produto está presente em alguma venda já realizada!";
        exit;
    }

    if ($produtoService->excluir($produto)) {
        echo "Produto excluído com sucesso!";
        exit;
    }

    throw new Exception("Erro ao excluir Produto");

} catch (Exception $e) {
    $message = $e->getMessage();
    echo $message;
    exit;
}
