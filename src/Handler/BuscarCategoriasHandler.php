<?php

namespace App\Handler;

require '../../vendor/autoload.php';

use App\Service\Categoria\CategoriaService;
use Exception;

try {
    session_start();

    if (isset($_POST['acao'])) {
        $acao = $_POST['acao'];
    } else {
        $acao = 'listartabela';
    }

    $CategoriaService = new CategoriaService();

    $Categoria = $CategoriaService->listar();

    foreach($Categoria as $Categoria) {
        $id_Categoria = $Categoria['id_categoria'];
        $nome = $Categoria['nome_categoria'];

        if ($acao == 'listartabela') {
            $json = json_encode($Categoria);
            echo "<tr>
                    <th scope='row'>$id_Categoria</th>
                    <th>$nome</th>
                    <td>
                        <button class='btn btn-primary' type='button' onclick='editar($id_Categoria, $json)'>Editar</button>
                        <button class='btn btn-danger' type='button' onclick='excluir($id_Categoria)'>Excluir</button>
                </td>
            </tr>";
        }

        if ($acao == 'listarform') {
            echo "<option value='$id_Categoria'>$nome</option>";
        }
    }
} catch (Exception $e) {
    $message = $e->getMessage();
    echo $message;
    exit;
}

