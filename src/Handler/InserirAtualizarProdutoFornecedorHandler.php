<?php

namespace App\Handler;

require '../../vendor/autoload.php';

use App\Entity\Fornecedores_produtos;
use App\Entity\Produtos;
use App\Service\Fornecedor\FornecedorProdutoService;
use App\Util\ValidarCampos;
use Exception;

try {
    $validar = new ValidarCampos();

    $produto = new Fornecedores_produtos();

    $id_produto = $validar->validarCampo($_POST["id_produto"], 'id_produto');
    $id_fornecedor = $validar->validarCampo($_POST["id_fornecedor"], 'id_fornecedor');
    $custo = $validar->validarCampo($_POST["custo"], 'custo');

    $produto->setId_fornecedor($id_fornecedor);
    $produto->setId_produto($id_produto);
    $produto->setCusto($custo);

    $fornecedorProdutoService = new FornecedorProdutoService();

    if ($fornecedorProdutoService->inserir($produto)) {
        echo "Fornecedor incluído ao produto com sucesso!";
        exit;
    } else {
        throw new Exception("Erro ao incluir produto!", 500);
        exit;
    }

} catch (Exception $e) {
    $message = $e->getMessage();
    echo $message;
    exit;
}
