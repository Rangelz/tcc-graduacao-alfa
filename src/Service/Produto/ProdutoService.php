<?php

declare(strict_types=1);

namespace App\Service\Produto;

use App\Entity\Produtos;
use App\Entity\Produtos_vendas;
use App\Repository\ProdutoRepository;

class ProdutoService
{
    /**
     * @var ProdutoRepository
     */
    private $ProdutoRepository;

    public function __construct()
    {
        $this->ProdutoRepository = new ProdutoRepository();
    }

    public function inserir(Produtos $Produto)
    {
        return $this->ProdutoRepository->inserirProduto($Produto);
    }

    public function inserirProdutoVenda(Produtos_vendas $produtos)
    {
        return $this->ProdutoRepository->inserirProdutoVenda($produtos);
    }

    public function excluir(Produtos $Produto)
    {
        return $this->ProdutoRepository->excluirProduto($Produto);
    }

    public function editar(Produtos $Produto)
    {
        return $this->ProdutoRepository->editarProduto($Produto);
    }

    public function listar()
    {
        return $this->ProdutoRepository->buscarTodosProdutos();
    }

    public function listarPorFornecedor($idFornecedor)
    {
        return $this->ProdutoRepository->buscarTodosProdutosPorFornecedor($idFornecedor);
    }

    public function buscarValorUnitarioPorProduto(int $idProduto)
    {
        return $this->ProdutoRepository->buscarValorUnitario($idProduto);
    }

    public function diminuirEstoque(int $idProduto, int $quantidade)
    {
        return $this->ProdutoRepository->diminuirEstoque($idProduto, $quantidade);
    }

    public function aumentarEstoque($idProduto, $quantidade)
    {
        return $this->ProdutoRepository->aumentarEstoque($idProduto, $quantidade);
    }

    public function verificarSeProdutoJaFoiVendido(int $idProduto)
    {
        return $this->ProdutoRepository->verificarSeProdutoJaFoiVendido($idProduto);
    }

}