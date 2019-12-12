<?php

namespace App\Handler;

require '../../vendor/autoload.php';

use App\Entity\Usuarios;
use App\Service\Usuario\UsuarioService;
use App\Service\Usuario\ValidarUsuarioService;
use App\Util\ValidarCampos;
use Exception;

try {
    $validar = new ValidarCampos();

    $usuario  = new Usuarios;
    
    if ($_POST["id"]) {
        $id = $validar->validarCampo($_POST["id"], 'id');
        $usuario->setId($id);
    }

    $nome = $validar->validarCampo($_POST["nome"], 'Nome');
    $email = $validar->validarCampo($_POST["email"], 'E-mail');

    if ($_POST["senha"]) {
        $senha = $validar->validarCampo($_POST["senha"], 'Senha');
    }
    
    $user = $validar->validarCampo($_POST["user"], 'Usuario');
    
    $usuario->setNome($nome);
    $usuario->setEmail($email);

    if ($_POST["senha"]) {
        $usuario->setSenha(password_hash($senha, PASSWORD_DEFAULT));
    }

    $usuario->setUser($user);

    $usuarioservice = new UsuarioService();
    $validarUsuarioService = new ValidarUsuarioService();

    if (isset($id)) {
        if ($usuarioservice->editar($usuario)) {
            echo "Usuario editado com sucesso!";
            exit;
        }
        throw new Exception("Erro ao editar Usuario!", 500);
    }

    if (!isset($_POST["id"])) {
        if ($validarUsuarioService->buscarLogin($usuario) !== false) {
            throw new Exception("Usuário '$user' já existe");
        }
    }

    if ($usuarioservice->inserir($usuario)) {
        echo "Usuario incluído com sucesso!";
        exit;
    }
    throw new Exception("Erro ao incluir Usuario!", 500);

} catch (Exception $e) {
    $message = $e->getMessage();
    echo $message;
    exit;
}
