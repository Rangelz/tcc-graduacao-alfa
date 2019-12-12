<?php

declare(strict_types=1);

namespace App\Repository;

use App\Connection\PDOConnection;
use App\Entity\Clientes;
use PDO;

class clienteRepository
{
    /**
     * @var PDOConnection
     */
    private $pdo;

    public function __construct()
    {
        $this->pdo = new PDOConnection();
    }

    public function inserirCliente(Clientes $cliente)
    {
        $sql =
            "INSERT INTO Clientes (	
                    nome,
                    sobrenome,
                    endereco,
                    email,
                    telefone,
                    cpf)
                VALUES (
                    :nome,
                    :sobrenome,
                    :endereco,
                    :email,
                    :telefone,
                    :cpf
            )";
        $inserir = $this->pdo->pdo()->prepare($sql);
        $inserir->bindValue(':nome', $cliente->getnome());
        $inserir->bindValue(':sobrenome', $cliente->getsobrenome());
        $inserir->bindValue(':endereco', $cliente->getendereco());
        $inserir->bindValue(':email', $cliente->getemail());
        $inserir->bindValue(':telefone', $cliente->gettelefone());
        $inserir->bindValue(':cpf', $cliente->getcpf());
        if ($inserir->execute()) {
            return true;
        }

        return false;
        
    }

    public function editarCliente(Clientes $cliente)
    {
        $sql =
            "UPDATE Clientes SET 
                    nome = :nome,
                    sobrenome = :sobrenome,
                    endereco = :endereco,
                    email = :email,
                    telefone = :telefone,
                    cpf = :cpf
                WHERE id_cliente = :id_cliente";
        $editar = $this->pdo->pdo()->prepare($sql);
        $editar->bindValue(':id_cliente', $cliente->getid_cliente());
        $editar->bindValue(':nome', $cliente->getnome());
        $editar->bindValue(':sobrenome', $cliente->getsobrenome());
        $editar->bindValue(':endereco', $cliente->getendereco());
        $editar->bindValue(':email', $cliente->getemail());
        $editar->bindValue(':telefone', $cliente->gettelefone());
        $editar->bindValue(':cpf', $cliente->getcpf());
        if ($editar->execute()) {
            return true; //TODO
        }

        return false;
    }

    public function excluirCliente(Clientes $cliente)
    {
        $sql = "DELETE FROM clientes WHERE id_cliente = ?";
        $editar = $this->pdo->pdo()->prepare($sql);
        $editar->bindValue(1, $cliente->getId_cliente(), PDO::PARAM_INT);

         if ($editar->execute()) {
             return true; //TODO
         }

         return false;
    }

    public function buscarTodosClientes()
    {
        $sql = "SELECT * FROM Clientes";
        $consulta = $this->pdo->pdo()->prepare($sql);
        $consulta->execute();

        $dados = $consulta->fetchAll();

        return $dados;
    }
}
