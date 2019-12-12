<?php

namespace App\Handler;

require '../../vendor/autoload.php';


use App\Service\Relatorio\RelatorioService;
use Exception;

try {
    session_start();

    $cpf = $_POST["cpf"];
    $nome = $_POST["nome"];

    $relatorioService = new RelatorioService();
    $dados = $relatorioService->gerarRelatorioClientes($cpf, $nome);
    
    $htmlFinal = '<table id="tabela" class=" tabela table table-striped table-advance table-hover"> 
        <thead> 
            <tr>  
                <th> ID </th>
                <th> Nome </th>   
                <th> Sobrenome </th>
                <th> Endereço </th>
                <th> Email </th>
                <th> Telefone </th>
                <th> CPF </th> 
                <th> Quantidade Compras </th>
                <th> Total Comprado </th>
            </tr> 
        </thead> 
        <tbody>';

    foreach ($dados as $dado) {
        $htmlFinal .= "<tr>  
                <td> {$dado["id_cliente"]} </td>
                <td> {$dado["nome"]} </td>   
                <td> {$dado["sobrenome"]} </td>
                <td> {$dado["endereco"]} </td>
                <td> {$dado["email"]} </td>
                <td> {$dado["telefone"]} </td>
                <td> {$dado["cpf"]} </td> 
                <td> {$dado["quantidade"]} </td>
                <td> {$dado["total"]} </td>
            </tr> ";
    }

    $htmlFinal .= "</tbody></table>";
    
    echo $htmlFinal;

} catch (Exception $e) {
    $message = $e->getMessage();
    echo $message;
    exit;
}

