<?php

declare(strict_types=1);

namespace App\Service\Fornecedor;

use App\Entity\Fornecedores;
use App\Entity\Fornecedores_produtos;
use App\Repository\FornecedorRepository;

class FornecedorProdutoService
{
    /**
     * @var FornecedorRepository
     */
    private $fornecedorRepository;

    public function __construct()
    {
        $this->fornecedorRepository = new FornecedorRepository();
    }

    public function inserir(Fornecedores_produtos $fornecedor)
    {
        return $this->fornecedorRepository->inserirFornecedorProduto($fornecedor);
    }

}