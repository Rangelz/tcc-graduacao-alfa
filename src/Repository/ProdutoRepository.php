<?php

declare(strict_types=1);

namespace App\Repository;

use App\Connection\PDOConnection;
use App\Entity\Produtos;
use App\Entity\Produtos_vendas;
use PDO;

class ProdutoRepository
{
    /**
     * @var PDOConnection
     */
    private $pdo;

    public function __construct()
    {
        $this->pdo = new PDOConnection();
    }

    public function inserirproduto(produtos $produto)
    {
        $sql =
            "INSERT INTO produtos (	
                        nome,
                        quantidade,
                        preco,
                        id_categoria,
                        id_fornecedor
                        )
                VALUES (
                    :nome,
                    :quantidade,
                    :preco,
                    :id_categoria,
                    :id_fornecedor)";
        $inserir = $this->pdo->pdo()->prepare($sql);
        $inserir->bindValue(':nome', $produto->getNome());
        $inserir->bindValue(':quantidade', $produto->getQuantidade(), PDO::PARAM_INT);
        $inserir->bindValue(':preco', $produto->getPreco());
        $inserir->bindValue(':id_categoria', $produto->getId_categoria(), PDO::PARAM_INT);
        $inserir->bindValue(':id_fornecedor', $produto->getId_fornecedor(), PDO::PARAM_INT);

        if ($inserir->execute()) {
            return true;
        } else {
            return false;
        }
    }

    public function inserirProdutoVenda(Produtos_vendas $produto)
    {
        $sql = "INSERT INTO produtos_vendas (id_produto, id_venda, quantidade, valor_unitario, valor_total) VALUES (:idproduto, :idvenda, :quantidade, :valorunitario, :valortotal)";
        $inserir = $this->pdo->pdo()->prepare($sql);

        $inserir->bindValue(':idproduto', (int) $produto->getId_produto(), PDO::PARAM_INT);
        $inserir->bindValue(':idvenda', (int) $produto->getId_venda(), PDO::PARAM_INT);
        $inserir->bindValue(':quantidade', $produto->getQuantidade(), PDO::PARAM_INT);
        $inserir->bindValue(':valorunitario', $produto->getValor_unitario());
        $inserir->bindValue(':valortotal', $produto->getValor_total());

        if ($inserir->execute()) {
            return true;
        } else {
            return false;
        }
    }

    public function editarproduto(produtos $produto)
    {
        $sql =
            "UPDATE produtos 
                SET 
                    nome = :nome,                
                    quantidade = :quantidade,
                    preco = :preco,
                    id_categoria = :id_categoria,
                    id_fornecedor = :idFornecedor
                WHERE
                    id_produto = :id_produto";
        $editar = $this->pdo->pdo()->prepare($sql);
        $editar->bindValue(':id_produto', $produto->getid_produto());
        $editar->bindValue(':nome', $produto->getnome());
        $editar->bindValue(':quantidade', $produto->getquantidade());
        $editar->bindValue(':preco', $produto->getpreco());
        $editar->bindValue(':id_categoria', $produto->getid_categoria());
        $editar->bindValue(':idFornecedor', $produto->getId_fornecedor());
        if ($editar->execute()) {
            return true;
        } else {
            return false;
        }
    }

    public function excluirproduto(produtos $produto)
    {
        $sql = "DELETE FROM produtos WHERE id_produto = ?";
        $excluir = $this->pdo->pdo()->prepare($sql);
        $excluir->bindValue(1, $produto->getId_produto());

        $excluir->execute();
        if ($excluir->execute()) {
            return true;
        } else {
            return false;
        }
    }

    public function buscarTodosProdutos()
    {
        $sql = 
            "SELECT 
                ps.*, 
                cs.nome_categoria as nome_categoria 
            FROM produtos ps 
            INNER JOIN categorias cs ON cs.id_categoria = ps.id_categoria";
        $consulta = $this->pdo->pdo()->prepare($sql);
        $consulta->execute();

        $dados = $consulta->fetchAll();

        return $dados;
    }

    public function buscarTodosProdutosPorFornecedor($idFornecedor)
    {
        $sql = 
            "SELECT 
                ps.*, 
                cs.nome_categoria as nome_categoria,
                fp.custo as preco_custo
            FROM produtos ps 
            INNER JOIN categorias cs ON cs.id_categoria = ps.id_categoria
            INNER JOIN fornecedores_produtos fp ON fp.id_produto = ps.id_produto
            WHERE ps.id_fornecedor = :idfornecedor";
        $consulta = $this->pdo->pdo()->prepare($sql);
        $consulta->bindParam(":idfornecedor", $idFornecedor);
        $consulta->execute();

        $dados = $consulta->fetchAll();

        return $dados;
    }

    public function diminuirEstoque($idProduto, $quantidade)
    {
        $sql = "UPDATE produtos SET quantidade = quantidade - :quantidade WHERE id_produto = :idProduto";
        $consulta = $this->pdo->pdo()->prepare($sql);
        $consulta->bindParam(':quantidade', $quantidade);
        $consulta->bindParam(':idProduto', $idProduto);
        
        if ($consulta->execute()) {
            return true;
        }

        return false;
    }

    public function aumentarEstoque($idProduto, $quantidade)
    {
        $sql = "UPDATE produtos SET quantidade = quantidade + :quantidade WHERE id_produto = :idProduto";
        $consulta = $this->pdo->pdo()->prepare($sql);
        $consulta->bindParam(':quantidade', $quantidade);
        $consulta->bindParam(':idProduto', $idProduto);
        
        if ($consulta->execute()) {
            return true;
        }

        return false;
    }

    public function buscarValorUnitario($idProduto)
    {
        $sql = 
            "SELECT 
                preco
            FROM produtos WHERE id_produto = ?"; 
        $consulta = $this->pdo->pdo()->prepare($sql);
        $consulta->bindParam(1, $idProduto);
        $consulta->execute();

        $dados = $consulta->fetchAll();

        return $dados;
    }

    public function verificarSeProdutoJaFoiVendido(int $idProduto)
    {
        $sql = 
            "SELECT 
                id_produto
            FROM produtos_vendas WHERE id_produto = ? LIMIT 1"; 
        $consulta = $this->pdo->pdo()->prepare($sql);
        $consulta->bindParam(1, $idProduto);
        $consulta->execute();

        $dados = $consulta->fetchAll();

        return $dados;
    }
}
