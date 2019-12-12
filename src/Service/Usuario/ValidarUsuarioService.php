<?php

declare(strict_types=1);

namespace App\Service\Usuario;

use App\Entity\Usuarios;
use App\Repository\UsuarioRepository;
use Exception;

class ValidarUsuarioService
{
    /**
     * @var UsuarioRepository
     */
    private $usuarioRepository;

    public function __construct()
    {
        $this->usuarioRepository = new UsuarioRepository();
    }

    public function validarUsuario(string $usuario, string $senha)
    {
        $user = new Usuarios();
        $user->setUser($usuario);
        $user->setSenha($senha);

        $user = $this->buscarLogin($user);

        if (!$user) {
            throw new Exception("Usuário não encontrado");
        }

        if (!password_verify($senha, $user->getSenha())) {
            throw new Exception("Senha incorreta");
        }

        return $user;
    }

    public function buscarLogin(Usuarios $usuario)
    {
        return $this->usuarioRepository->buscarPorLogin($usuario);
    }
}