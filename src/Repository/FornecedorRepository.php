<?php

declare(strict_types=1);

namespace App\Repository;

use App\Connection\PDOConnection;
use App\Entity\Fornecedores;
use App\Entity\Fornecedores_produtos;
use PDO;

class FornecedorRepository
{
    /**
     * @var PDOConnection
     */
    private $pdo;

    public function __construct()
    {
        $this->pdo = new PDOConnection();
    }

    public function inserirFornecedor(Fornecedores $fornecedor)
    {
        $sql =
            "INSERT INTO fornecedores (	
                    nome,
                    sobrenome,
                    endereco,
                    email,
                    telefone,
                    cpf_cnpj)
                VALUES (
                    :nome,
                    :sobrenome,
                    :endereco,
                    :email,
                    :telefone,
                    :cpf_cnpj
            )";
        $inserir = $this->pdo->pdo()->prepare($sql);
        $inserir->bindValue(':nome', $fornecedor->getnome());
        $inserir->bindValue(':sobrenome', $fornecedor->getsobrenome());
        $inserir->bindValue(':endereco', $fornecedor->getendereco());
        $inserir->bindValue(':email', $fornecedor->getemail());
        $inserir->bindValue(':telefone', $fornecedor->gettelefone());
        $inserir->bindValue(':cpf_cnpj', $fornecedor->getcpf_cnpj());
        if ($inserir->execute()) {
            return true;
        } else {
            return false;
        }
    }

    public function inserirFornecedorProduto(Fornecedores_produtos $fornecedor)
    {
        $sql = "
            INSERT INTO fornecedores_produtos (id_fornecedor, id_produto, custo) 
                VALUES
            (:id_fornecedor, :id_produto, :custo)
        ";
        $inserir = $this->pdo->pdo()->prepare($sql);
        $inserir->bindValue(':id_fornecedor', $fornecedor->getId_fornecedor());
        $inserir->bindValue(':id_produto', $fornecedor->getId_produto());
        $inserir->bindValue(':custo', $fornecedor->getCusto());
        if ($inserir->execute()) {
            return true;
        } else {
            return false;
        }
    }

    public function editarFornecedor(Fornecedores $fornecedor)
    {
        $sql =
            "UPDATE fornecedores SET 
                    nome = :nome,
                    sobrenome = :sobrenome,
                    endereco = :endereco,
                    email = :email,
                    telefone = :telefone,
                    cpf_cnpj = :cpf_cnpj
                    WHERE id_fornecedor = :id_fornecedor";
        $editar = $this->pdo->pdo()->prepare($sql);
        $editar->bindValue(':nome', $fornecedor->getnome());
        $editar->bindValue(':sobrenome', $fornecedor->getsobrenome());
        $editar->bindValue(':endereco', $fornecedor->getendereco());
        $editar->bindValue(':email', $fornecedor->getemail());
        $editar->bindValue(':telefone', $fornecedor->gettelefone());
        $editar->bindValue(':cpf_cnpj', $fornecedor->getcpf_cnpj());
        $editar->bindValue(':id_fornecedor', $fornecedor->getid_fornecedor());
        if ($editar->execute()) {
            return true;
        }

        return false;
    }

    public function excluirFornecedor(Fornecedores $fornecedor)
    {
        $sql = "DELETE FROM fornecedores WHERE id_fornecedor = ?";
        $excluir = $this->pdo->pdo()->prepare($sql);
        $excluir->bindValue(1, $fornecedor->getId_fornecedor(), PDO::PARAM_INT);

        if ($excluir->execute()) {
            return true;
        }

        return false;
    }

    public function buscarTodosFornecedores()
    {
        $sql = "SELECT * FROM fornecedores";
        $consulta = $this->pdo->pdo()->prepare($sql);
        $consulta->execute();

        $dados = $consulta->fetchAll();

        return $dados;
    }

    public function buscarTodosFornecedoresProduto($idProduto)
    {
        $sql = "SELECT
                    fn.nome as nome_fornecedor,
                    fn.`sobrenome` as sobrenome_fornecedor,
                    fp.custo as custo,
                    fn.id_fornecedor as id_fornecedor
                FROM fornecedores_produtos fp
                INNER JOIN fornecedores fn ON fn.`id_fornecedor` = fp.`id_fornecedor`
                WHERE id_produto = :idProduto";
        $consulta = $this->pdo->pdo()->prepare($sql);
        $consulta->bindParam(':idProduto', $idProduto);
        $consulta->execute();

        $dados = $consulta->fetchAll();

        return $dados;
    }
}
