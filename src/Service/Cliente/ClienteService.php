<?php

declare(strict_types=1);

namespace App\Service\Cliente;

use App\Entity\Clientes;
use App\Repository\clienteRepository;

class clienteService
{
    /**
     * @var ClienteRepository
     */
    private $clienteRepository;

    public function __construct()
    {
        $this->clienteRepository = new ClienteRepository();
    }

    public function inserir(Clientes $cliente)
    {
         return $this->clienteRepository->inserircliente($cliente);
    }

    public function excluir(Clientes $cliente)
    {
         return $this->clienteRepository->excluircliente($cliente);
    }

    public function editar(Clientes $cliente)
    {
         return $this->clienteRepository->editarcliente($cliente);
    }

    public function listar()
    {
         return $this->clienteRepository->buscarTodosclientes();
    }

}