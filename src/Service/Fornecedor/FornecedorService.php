<?php

declare(strict_types=1);

namespace App\Service\Fornecedor;

use App\Entity\Fornecedores;
use App\Repository\FornecedorRepository;

class FornecedorService
{
    /**
     * @var FornecedorRepository
     */
    private $fornecedorRepository;

    public function __construct()
    {
        $this->fornecedorRepository = new FornecedorRepository();
    }

    public function inserir(Fornecedores $fornecedor)
    {
        return $this->fornecedorRepository->inserirFornecedor($fornecedor);
    }

    public function excluir(Fornecedores $fornecedor)
    {
        return $this->fornecedorRepository->excluirFornecedor($fornecedor);
    }

    public function editar(Fornecedores $fornecedor)
    {
        return $this->fornecedorRepository->editarFornecedor($fornecedor);
    }

    public function listar()
    {
        return $this->fornecedorRepository->buscarTodosFornecedores();
    }

    public function listarFornecedorProduto($idProduto)
    {
        return $this->fornecedorRepository->buscarTodosFornecedoresProduto($idProduto);
    }

}