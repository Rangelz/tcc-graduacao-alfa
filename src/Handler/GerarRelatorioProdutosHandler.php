<?php

namespace App\Handler;

require '../../vendor/autoload.php';


use App\Service\Relatorio\RelatorioService;
use Exception;

try {
    session_start();
    
    $codigo = 0;
    if (!empty($_POST['codigo'])) {
       $codigo = (int) $_POST['codigo'];
    }
    
    $categoria = (int) $_POST["categoria"];
    $descricao = $_POST["descricao"];

    $sem_estoque = false;
    if ($_POST["sem_estoque"] === "true") {
        $sem_estoque = true;
    }

    $relatorioService = new RelatorioService();
    $dados = $relatorioService->gerarRelatorioProdutos($codigo, $descricao, $sem_estoque, $categoria);
    
    $htmlFinal = '<table id="tabela" class=" tabela table table-striped table-advance table-hover"> 
        <thead> 
            <tr>  
                <th> ID </th>
                <th> Nome </th>   
                <th> Categoria</th>
                <th> Preco</th>
                <th> Estoque </th>
                <th> Quantidade Venda </th>
                <th> Total Venda </th> 
            </tr> 
        </thead> 
        <tbody>';

    foreach ($dados as $dado) {
        $htmlFinal .= "<tr>  
                <td> {$dado["id_produto"]} </td>
                <td> {$dado["nome"]} </td>   
                <td> {$dado["nome_categoria"]} </td>
                <td> {$dado["preco"]} </td>
                <td> {$dado["quantidade"]} </td>
                <td> {$dado["quantidade_total_venda"]} </td> 
                <td> {$dado["valor_total_venda"]} </td>
            </tr> ";
    }

    $htmlFinal .= "</tbody></table>";
    
    echo $htmlFinal;

} catch (Exception $e) {
    $message = $e->getMessage();
    echo $message;
    exit;
}

