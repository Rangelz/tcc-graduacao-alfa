<?php

declare(strict_types=1);

namespace App\Repository;

use App\Connection\PDOConnection;
use App\Entity\Usuarios;
use PDO;

class UsuarioRepository
{
    /**
     * @var PDOConnection
     */
    private $pdo;

    public function __construct()
    {
        $this->pdo = new PDOConnection();
    }

    public function inserirUsuario(Usuarios $usuario)
    {
        $sql = "INSERT INTO usuarios (nome, email, user, senha) values (?, ?, ? ,?)";
        $inserir = $this->pdo->pdo()->prepare($sql);
        $inserir->bindValue(1, $usuario->getNome());
        $inserir->bindValue(2, $usuario->getEmail());
        $inserir->bindValue(3, $usuario->getUser());
        $inserir->bindValue(4, $usuario->getSenha());

        return $inserir->execute();
    }

    public function editarUsuario(Usuarios $usuario)
    {
        if ($usuario->getSenha() == null) {

            $sql = "UPDATE usuarios SET nome = ?, email = ?, user = ? WHERE id = ?";
            $editar = $this->pdo->pdo()->prepare($sql);
            $editar->bindValue(1, $usuario->getNome());
            $editar->bindValue(2, $usuario->getEmail());
            $editar->bindValue(3, $usuario->getUser());
            $editar->bindValue(4, $usuario->getId());
           
            return $editar->execute();
        } else {
            $sql = "UPDATE usuarios SET nome = ?, email = ?, user = ?, senha = ? WHERE id = ?";
            $editar = $this->pdo->pdo()->prepare($sql);
            $editar->bindValue(1, $usuario->getNome());
            $editar->bindValue(2, $usuario->getEmail());
            $editar->bindValue(3, $usuario->getUser());
            $editar->bindValue(5, $usuario->getSenha());
            $editar->bindValue(4, $usuario->getId(), PDO::PARAM_INT);
           
            return $editar->execute();
        }
    }

    public function excluirUsuario(Usuarios $usuario)
    {
        $sql = "DELETE FROM usuarios WHERE id = ?";
        $excluir = $this->pdo->pdo()->prepare($sql);
        $excluir->bindValue(1, $usuario->getId());
        
        return $excluir->execute();
    }
    
    public function buscarPorLogin(Usuarios $usuario)
    {
        $sql = "SELECT * FROM usuarios WHERE user = ?";
        $consulta = $this->pdo->pdo()->prepare($sql);
        $consulta->bindValue(1, $usuario->getUser());
        $consulta->execute();
        $dados = $consulta->fetchObject(Usuarios::class);
        
        return $dados;
    }
    
    public function buscarTodosUsuarios()
    {
        $sql = "SELECT * FROM usuarios";
        $consulta = $this->pdo->pdo()->prepare($sql);
        $consulta->execute();

        $dados = $consulta->fetchAll();

        return $dados;
    }
}