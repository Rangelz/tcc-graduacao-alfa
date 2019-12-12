<?php

declare(strict_types=1);

namespace App\Service\Relatorio;


use App\Repository\RelatorioRepository;

class RelatorioService
{    
    /**
     * @var RelatorioRepository
     */
    private $relatorioRepository;

    public function __construct()
    {
        $this->relatorioRepository = new RelatorioRepository();
    }

    public function gerarRelatorioClientes($cpf, $nome)
    {
        return $this->relatorioRepository->gerarRelatorioClientes($cpf, $nome);
    }

    public function gerarRelatorioProdutos($codigo, $descricao, $sem_estoque, $categoria)
    {
        return $this->relatorioRepository->gerarRelatorioProdutos($codigo, $descricao, $sem_estoque, $categoria);
    }

    public function gerarRelatorioVendas($cpf, $tipopagamento, $datainicial, $datafinal)
    {
        return $this->relatorioRepository->gerarRelatorioVendas($cpf, $tipopagamento, $datainicial, $datafinal);
    }

}
