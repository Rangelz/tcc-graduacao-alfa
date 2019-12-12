<?php

namespace App\Handler;

require '../../vendor/autoload.php';

use App\Service\Usuario\ValidarUsuarioService;
use Exception;

try {
    session_start();

    $usuario = $_POST["login"];
    $senha = $_POST["senha"];

    $usuarioValidado = new ValidarUsuarioService;
    $usuario = $usuarioValidado->validarUsuario($usuario, $senha);

    $_SESSION["sistema"] = array(
        "id" => $usuario->getId(),
        "user" => $usuario->getUser(),
        "nome" => $usuario->getNome()
    );

    header("Location: ../../public/home.php?fd=.&pg=relatorios");
    /*header("Location: ../../public/home.php");*/
} catch (Exception $e) {
    $message = $e->getMessage();
    echo "<script>alert('$message');history.back()</script>";
    exit;
}
