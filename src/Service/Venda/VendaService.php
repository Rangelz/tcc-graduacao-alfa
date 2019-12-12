<?php

declare(strict_types=1);

namespace App\Service\Venda;

use App\Entity\Vendas;
use App\Repository\VendaRepository;

class VendaService
{
    private $vendaRepository;

    public function __construct()
    {
        $this->vendaRepository = new VendaRepository();
    }

    public function inserir(Vendas $venda)
    {
        return $this->vendaRepository->inserirVenda($venda);
    }

    public function adicionarValorTotal(Vendas $venda)
    {
        return $this->vendaRepository->adicionarValorTotal($venda);
    }

    public function listar()
    {
        return $this->vendaRepository->buscarTodosVenda();
    }

}