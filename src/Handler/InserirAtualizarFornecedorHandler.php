<?php

namespace App\Handler;

require '../../vendor/autoload.php';

use App\Entity\Fornecedores;
use App\Service\Fornecedor\FornecedorService;
use App\Util\ValidarCampos;
use Exception;

try {
    $validar = new ValidarCampos();

    $fornecedor = new Fornecedores();

    if ($_POST["id_fornecedor"]) {
        $id = $validar->validarCampo($_POST["id_fornecedor"], 'id_fornecedor');
        $fornecedor->setId_fornecedor($id);
    }

    $nome = $validar->validarCampo($_POST["nome"], 'Nome');
    $sobrenome = $validar->validarCampo($_POST["sobrenome"], 'Sobrenome');
    $endereco = $validar->validarCampo($_POST["endereco"], 'Endereço');
    $email = $validar->validarCampo($_POST["email"], 'E-mail');
    $telefone = $validar->validarCampo($_POST["telefone"], 'Telefone');
    $cpf_cnpj = $validar->validarCampo($_POST["cpf_cnpj"], 'CPF/CNPJ');

    $fornecedor->setNome($nome);
    $fornecedor->setSobrenome($sobrenome);
    $fornecedor->setEndereco($endereco);
    $fornecedor->setEmail($email);
    $fornecedor->setTelefone($telefone);
    $fornecedor->setCpf_cnpj($cpf_cnpj);

    $fornecedorService = new FornecedorService();

    if (isset($id)) {
        if ($fornecedorService->editar($fornecedor)) {
            echo "Fornecedor editado com sucesso!";
            exit;
        } else {
            throw new Exception("Erro ao editar fornecedor fornecedor!", 500);
            exit;
        }
    } else {
        if ($fornecedorService->inserir($fornecedor)) {
            echo "Fornecedor incluído com sucesso!";
            exit;
        } else {
            throw new Exception("Erro ao incluir fornecedor!", 500);
            exit;
        }
    }

} catch (Exception $e) {
    $message = $e->getMessage();
    echo $message;
    exit;
}
