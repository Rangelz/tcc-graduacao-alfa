<?php

namespace App\Handler;

require '../../vendor/autoload.php';

use App\Entity\Produtos;
use App\Service\Produto\ProdutoService;
use App\Util\ValidarCampos;
use Exception;

try {
    $validar = new ValidarCampos();

    $produto = new produtos();

    if ($_POST["id_produto"]) {
        $id = $validar->validarCampo($_POST["id_produto"], 'id_produto');
        $produto->setId_produto($id);
    }

    $nome = $validar->validarCampo($_POST["nome"], 'Nome');
    $quantidade = $validar->validarCampo($_POST["quantidade"], 'Quantidade');
    $preco = $validar->validarCampo($_POST["preco"], 'Preco');
    $id_categoria = $validar->validarCampo($_POST["id_categoria"], 'id_categoria');
    $idFornecedor = $validar->validarCampo($_POST["idFornecedor"],'Fornecedor');

    $produto->setNome($nome);
    $produto->setQuantidade($quantidade);
    $produto->setPreco($preco);
    $produto->setId_categoria($id_categoria);
    $produto->setId_fornecedor($idFornecedor);

    $produtoService = new ProdutoService();

    if (isset($id)) {
        if ($produtoService->editar($produto)) {
            echo "produto editado com sucesso!";
            exit;
        } else {
            throw new Exception("Erro ao editar produto produto!", 500);
            exit;
        }
    } else {
        if ($produtoService->inserir($produto)) {
            echo "produto incluído com sucesso!";
            exit;
        } else {
            throw new Exception("Erro ao incluir produto!", 500);
            exit;
        }
    }

} catch (Exception $e) {
    $message = $e->getMessage();
    echo $message;
    exit;
}
