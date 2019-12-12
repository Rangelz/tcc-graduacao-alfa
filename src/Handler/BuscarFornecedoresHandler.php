<?php

namespace App\Handler;

require '../../vendor/autoload.php';

use App\Entity\Fornecedores;
use App\Service\Fornecedor\FornecedorService;
use Exception;

try {
    session_start();

    if (isset($_POST['acao'])) {
        $acao = $_POST['acao'];
    } else {
        $acao = 'listartabela';
    }
    $fornecedorService = new FornecedorService();

    $fornecedores = $fornecedorService->listar();

    foreach($fornecedores as $fornecedor) {
        $id_fornecedor = $fornecedor['id_fornecedor'];
        $nome = $fornecedor['nome'];
        $sobrenome = $fornecedor['sobrenome'];
        $endereco = $fornecedor['endereco'];
        $email = $fornecedor['email'];
        $telefone = $fornecedor['telefone'];
        $cpf_cnpj = $fornecedor['cpf_cnpj'];

        $json = json_encode($fornecedor);

        if ($acao == 'listartabela') {
            echo "<tr>
                    <th scope='row'>$id_fornecedor</th>
                    <th>$nome</th>
                    <td>$sobrenome</td>
                    <td>$endereco</td>
                    <td>$email</td>
                    <td>$telefone</td>
                    <td>$cpf_cnpj</td>
                    <td>
                        <button class='btn btn-primary' type='button' onclick='editar($id_fornecedor, $json)'>Editar</button>
                        <button class='btn btn-danger' type='button' onclick='excluir($id_fornecedor)'>Excluir</button>
                        <button class='btn btn-success' type='button' onclick='modalProduto($id_fornecedor)' data-toggle='modal' data-target='#modalProduto'>P</button>
                    </td>
                </tr>";
        }

        if ($acao == 'listarform') {
            echo "<option value='$id_fornecedor'>$nome $sobrenome - $cpf_cnpj</option>";
        }

    }

} catch (Exception $e) {
    $message = $e->getMessage();
    echo $message;
    exit;
}

