<?php

declare(strict_types=1);

namespace App\Repository;

use App\Connection\PDOConnection;
use App\Entity\Categorias;
use PDO;

class CategoriaRepository
{
    /**
     * @var PDOConnection
     */
    private $pdo;

    public function __construct()
    {
        $this->pdo = new PDOConnection();
    }

    public function inserirCategoria(Categorias $Categoria)
    {
        $sql = "INSERT INTO Categorias (nome_categoria) VALUES (:nome)";
        $inserir = $this->pdo->pdo()->prepare($sql);
        $inserir->bindValue(':nome', $Categoria->getnome_categoria());
        if ($inserir->execute()) {
            return true;
        }

        return false;
        
    }

    public function editarCategoria(Categorias $Categoria)
    {
        $sql =
            "UPDATE Categorias SET nome_categoria = :nome WHERE id_categoria = :id_categoria";
        $editar = $this->pdo->pdo()->prepare($sql);
        $editar->bindValue(':id_categoria', $Categoria->getid_Categoria(), PDO::PARAM_INT);
        $editar->bindValue(':nome', $Categoria->getnome_categoria());
        if ($editar->execute()) {
            return true;
        }

        return false;
    }

    public function excluirCategoria(Categorias $Categoria)
    {
        $sql = "DELETE FROM Categorias WHERE id_categoria = ?";
        $editar = $this->pdo->pdo()->prepare($sql);
        $editar->bindValue(1, $Categoria->getId_Categoria(), PDO::PARAM_INT);

         if ($editar->execute()) {
             return true;
         }

         return false;
    }

    public function buscarTodosCategorias()
    {
        $sql = "SELECT * FROM Categorias";
        $consulta = $this->pdo->pdo()->prepare($sql);
        $consulta->execute();

        $dados = $consulta->fetchAll();

        return $dados;
    }
}
