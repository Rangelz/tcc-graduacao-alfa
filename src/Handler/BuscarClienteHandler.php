<?php

namespace App\Handler;

require '../../vendor/autoload.php';

use App\Service\Cliente\ClienteService;
use Exception;

try {
    session_start();
        
    if (isset($_POST["acao"])) {
        $acao = $_POST["acao"];
    } else {
        $acao = 'listartabela';
    }

    $clienteService = new ClienteService();

    $clientes = $clienteService->listar();
        
    foreach($clientes as $clientes) {
        $id_cliente = $clientes['id_cliente'];
        $nome = $clientes['nome'];
        $sobrenome = $clientes['sobrenome'];
        $endereco = $clientes['endereco'];
        $email = $clientes['email'];
        $telefone = $clientes['telefone'];
        $cpf = $clientes['cpf'];
        
        $json = json_encode($clientes);
        
        if ($acao == 'listartabela') {
            echo "<tr>
                    <th scope='row'>$id_cliente</th>
                    <th>$nome</th>
                    <td>$sobrenome</td>
                    <td>$endereco</td>
                    <td>$email</td>
                    <td>$telefone</td>
                    <td>$cpf</td>
                    <td>
                        <button class='btn btn-primary' type='button' onclick='editar($id_cliente, $json)'>Editar</button>
                        <button class='btn btn-danger' type='button' onclick='excluir($id_cliente)'>Excluir</button>
                    </td>
                </tr>";
        }

        if ($acao == 'listarform') {
            echo "<option value='$id_cliente'>$nome $sobrenome</option>";
        }
    }

} catch (Exception $e) {
    $message = $e->getMessage();
    echo $message;
    exit;
}
