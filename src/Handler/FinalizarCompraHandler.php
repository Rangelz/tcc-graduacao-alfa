<?php

namespace App\Handler;

use App\Entity\Produtos;
use App\Entity\Produtos_vendas;
use App\Entity\Vendas;
use App\Service\Produto\ProdutoService;
use App\Service\Venda\VendaService;
use Exception;

require '../../vendor/autoload.php';

try {
    session_start();

    #INSERIR A VENDA
    $venda = new Vendas();
    $venda->setDataVenda(date('Y/m/d'));
    $venda->setId_cliente($_POST['idcliente']);
    $venda->setPagamento($_POST['tipopagamento']);
    $venda->setTotal_venda(0);

    $vendaService = new VendaService();

    $idVenda = $vendaService->inserir($venda);

    $venda->setId_venda($idVenda);

    #INSERIR OS PRODUTOS
    $produtos = json_decode($_POST["produtos"], true);

    $produtoService = new ProdutoService();

    $valorTotalVenda = 0;

    foreach($produtos as $produto) {
        if ($produto) {
            $idProduto = (int) $produto['id'];
            $valorUnitario = (float) $produtoService->buscarValorUnitarioPorProduto($idProduto)[0]["preco"];

            $quantidade = (int) $produto['quantidade'];
            $valorTotal = $valorUnitario * $quantidade;

            $produtovenda = new Produtos_vendas();

            $produtovenda->setId_venda(intVal($idVenda));
            $produtovenda->setId_produto($idProduto);
            $produtovenda->setQuantidade($quantidade);
            $produtovenda->setValor_unitario($valorUnitario);
            $produtovenda->setValor_unitario($valorUnitario);
            $produtovenda->setValor_total($valorTotal);

            $produto = new Produtos();
            $produto->setQuantidade($quantidade);

            $produtoService->diminuirEstoque($idProduto, $quantidade);
            
            $valorTotalVenda += $valorTotal;
            if (!$produtoService->inserirProdutoVenda($produtovenda)) {
                throw new Exception("Erro ao realizar a venda!");
            }
        }
    }

    #ADICIONAR VALOR TOTAL A VENDA
    $venda->setTotal_venda($valorTotalVenda);
    $vendaService->adicionarValorTotal($venda);
    echo "Venda feita com sucesso!";
    exit;

} catch (Exception $e) {
    echo $e->getMessage();
    exit;
}
