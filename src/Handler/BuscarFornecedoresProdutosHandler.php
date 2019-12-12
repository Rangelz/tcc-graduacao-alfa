<?php

namespace App\Handler;

require '../../vendor/autoload.php';

use App\Service\Fornecedor\FornecedorService;
use Exception;

try {
    session_start();

    $idProduto = (int) $_POST["id_produto"];

    $fornecedorService = new FornecedorService();

    $fornecedores = $fornecedorService->listarFornecedorProduto($idProduto);

    foreach ($fornecedores as $fornecedor) {
        $id_fornecedor = $fornecedor['id_fornecedor'];
        $nome_fornecedor = $fornecedor['nome_fornecedor'];
        $sobrenome_fornecedor = $fornecedor['sobrenome_fornecedor'];
        $custo = $fornecedor['custo'];

        echo "<tr>
                <th scope='row'>$id_fornecedor</th>
                <td>$nome_fornecedor $sobrenome_fornecedor</td>
                <td>R$ $custo</td>
             </tr>";
    }
} catch (Exception $e) {
    $message = $e->getMessage();
    echo $message;
    exit;
}
