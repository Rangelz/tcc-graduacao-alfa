<?php

namespace App\Handler;

require '../../vendor/autoload.php';

use App\Service\Produto\ProdutoService;
use Exception;

try {
    session_start();

    if (isset($_POST['acao'])) {
        $acao = $_POST['acao'];
    } else {
        $acao = 'listartabela';
    }

    $ProdutoService = new ProdutoService();

    $produtos = $ProdutoService->listar();

    foreach($produtos as $produto) {
        $id_produto = $produto['id_produto'];
        $nome = $produto['nome'];
        $quantidade = $produto['quantidade'];
        $preco = $produto['preco'];
        $id_categoria = $produto['id_categoria'];
        $nome_categoria = $produto['nome_categoria'];
        $id_fornecedor = $produto['id_fornecedor'];

        $json = json_encode($produto);

        if ($acao == 'listartabela') {
            echo "<tr>
                    <th scope='row'>$id_produto</th>
                    <th>$nome</th>
                    <td>$nome_categoria</td>
                    <td>$quantidade</td>
                    <td>R$ $preco</td>
                    <td>
                        <button class='btn btn-primary' type='button' onclick='editar($id_produto, $json)'>Editar</button>
                        <button class='btn btn-danger' type='button' onclick='excluir($id_produto)'>Excluir</button>
                        <button class='btn btn-success' type='button' onclick='fornecedor($id_produto)' data-toggle='modal' data-target='#modalProdutoFornecedor'>Fornecedor</button>
                        <button class='btn btn-secondary' type='button' onclick='modalQuantidade($id_produto, $quantidade, \"$nome\")' data-toggle='modal' data-target='#modalQuantidade'>+</button>
                    </td>
                </tr>";
        }

        if ($acao == 'listarform') {
            echo "<option value='$id_produto'>$nome</option>";
        }

        if ($acao == 'listarpreco') {
            echo "<input type='hidden' id='$id_produto' value='$preco'>";
        }
    }
} catch (Exception $e) {
    $message = $e->getMessage();
    echo $message;
    exit;
}
