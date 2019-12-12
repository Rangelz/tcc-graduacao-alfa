<?php

namespace App\Handler;

require '../../vendor/autoload.php';

use App\Entity\Clientes;
use App\Service\Cliente\ClienteService;
use App\Util\ValidarCampos;
use Exception;

try {
    $validar = new ValidarCampos();

    $cliente  = new Clientes;
    
    if ($_POST["id_cliente"]) {
        $id = $validar->validarCampo($_POST["id_cliente"], 'id_cliente');
        $cliente->setId_cliente($id);
    }

    $nome = $validar->validarCampo($_POST["nome"], 'Nome');
    $sobrenome = $validar->validarCampo($_POST["sobrenome"], 'Sobrenome');
    $endereco = $validar->validarCampo($_POST["endereco"], 'Endereço');
    $email = $validar->validarCampo($_POST["email"], 'E-mail');
    $telefone = $validar->validarCampo($_POST["telefone"], 'Telefone');
    $cpf = $validar->validarCampo($_POST["cpf"], 'CPF');

    $cliente->setNome($nome);
    $cliente->setSobrenome($sobrenome);
    $cliente->setEndereco($endereco);
    $cliente->setEmail($email);
    $cliente->setTelefone($telefone);
    $cliente->setCpf($cpf);

    $clienteService = new ClienteService();

    if (isset($id)) {
        if ($clienteService->editar($cliente)) {
            echo "Cliente editado com sucesso!";
            exit;
        } else {
            throw new Exception("Erro ao editar cliente!", 500);
            exit;
        }
    } else {
        if ($clienteService->inserir($cliente)) {
            echo "cliente incluído com sucesso!";
            exit;
        } else {
            throw new Exception("Erro ao incluir cliente!", 500);
            exit;
        }
    }


} catch (Exception $e) {
    $message = $e->getMessage();
    echo $message;
    exit;
}
