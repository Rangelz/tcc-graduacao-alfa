<?php

namespace App\Handler;

require '../../vendor/autoload.php';


use App\Service\Relatorio\RelatorioService;
use Exception;

try {
    session_start();
       
    $cpf = $_POST['cpf']; 
    $tipopagamento = $_POST['tipoPagamento'];
    $datainicial = $_POST['dataInicio'];
    $datafinal = $_POST['dataFim']; 

    $relatorioService = new RelatorioService();
    $dados = $relatorioService->gerarRelatorioVendas($cpf, $tipopagamento, $datainicial, $datafinal);
    
    $htmlFinal = '<table id="tabela" class=" tabela table table-striped table-advance table-hover"> 
        <thead> 
            <tr>  
                <th> ID Venda </th>
                <th> Data Venda</th>
                <th> Pagamento </th>   
                <th> CPF </th>
                <th> Cliente </th>
                <th> Quantidade </th>
                <th> Total Venda </th>
            </tr> 
        </thead> 
        <tbody>';

    foreach ($dados as $dado) {
        $htmlFinal .= "<tr>  
                <td> {$dado["id_venda"]} </td>
                <td> {$dado["dataVenda"]} </td>   
                <td> {$dado["pagamento"]} </td>
                <td> {$dado["cpf"]} </td>
                <td> {$dado["cliente"]} </td>
                <td> {$dado["quantidade_total"]} </td>
                <td> {$dado["total_venda"]} </td>
            </tr> ";

    }

    $htmlFinal .= "</tbody></table>";
    
    echo $htmlFinal;

} catch (Exception $e) {
    $message = $e->getMessage();
    echo $message;
    exit;
}

