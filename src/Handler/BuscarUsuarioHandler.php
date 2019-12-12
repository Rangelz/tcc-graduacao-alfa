<?php

namespace App\Handler;

require '../../vendor/autoload.php';

use App\Service\Usuario\UsuarioService;
use Exception;

try {
    session_start();

    $UsuarioService = new UsuarioService();

    $usuarios = $UsuarioService->listar();
        

    echo "
        <table class='table table-striped' id='tabelatable'>
            <thead>
                <tr>
                    <th scope='col'>ID</th>
                    <th scope='col'>Nome</th>
                    <th scope='col'>E-mail</th>
                    <th scope='col'>Usuario</th>
                    <th scope='col'>Ações</th>
                        </tr>
            </thead>
            <tbody id='tabelalistagem'>
            ";


    foreach($usuarios as $usuario) {
        $id = $usuario['id'];
        $nome = $usuario['nome'];
        $email = $usuario['email'];
        $user = $usuario['user'];
        
        $json = json_encode($usuario);
        
        echo "<tr>
                <th scope='row'>$id</th>
                <th>$nome</th>
                <td>$email</td>
                <td>$user</td>
                <td>
                    <button class='btn btn-primary' type='button' onclick='editar($id, $json)'>Editar</button>
                    <button class='btn btn-danger' type='button' onclick='excluir($id)'>Excluir</button>
                </td>
            </tr>";
    }

    echo "    </tbody>
    </table>";

} catch (Exception $e) {
    $message = $e->getMessage();
    echo $message;
    exit;
}
