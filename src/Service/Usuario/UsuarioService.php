<?php

declare(strict_types=1);

namespace App\Service\Usuario;

use App\Entity\Usuarios;
use App\Repository\UsuarioRepository;

class UsuarioService
{
    /**
     * @var UsuarioRepository
     */
    private $usuarioRepository;

    public function __construct()
    {
        $this->usuarioRepository = new UsuarioRepository();
    }

    public function inserir(Usuarios $Usuario)
    {
         return $this->usuarioRepository->inserirUsuario($Usuario);
    }

    public function excluir(Usuarios $Usuario)
    {
         return $this->usuarioRepository->excluirUsuario($Usuario);
    }

    public function editar(Usuarios $Usuario)
    {
         return $this->usuarioRepository->editarUsuario($Usuario);
    }

    public function listar()
    {
         return $this->usuarioRepository->buscarTodosUsuarios();
    }

}