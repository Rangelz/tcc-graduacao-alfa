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

    $idFornecedor = (int) $_POST["id_fornecedor"];

    $ProdutoService = new ProdutoService();

    $produtos = $ProdutoService->listarPorFornecedor($idFornecedor);

    foreach ($produtos as $produto) {
        $id_produto = $produto['id_produto'];
        $nome = $produto['nome'];
        $quantidade = $produto['quantidade'];
        $preco = $produto['preco'];
        $id_categoria = $produto['id_categoria'];
        $preco_custo = $produto['preco_custo'];
        $nome_categoria = $produto['nome_categoria'];
        $id_fornecedor = $produto['id_fornecedor'];

        if ($acao == 'listartabela') {
            if ($produto['id_fornecedor'] == $idFornecedor) {
                echo "<tr>
                    <th scope='row'>$id_produto</th>
                    <td>$nome_categoria</td>
                    <th>$nome</th>
                    <td>$quantidade</td>
                    <td>$preco</td>
                    <td>$preco_custo</td>
                </tr>";
            }
        }
    }
} catch (Exception $e) {
    $message = $e->getMessage();
    echo $message;
    exit;
}
