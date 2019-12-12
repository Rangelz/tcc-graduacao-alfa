<?php

declare(strict_types=1);

namespace App\Repository;

use App\Connection\PDOConnection;
use App\Entity\Vendas;
use PDO;

class VendaRepository
{
    /**
     * @var PDOConnection
     */
    private $pdo;

    public function __construct()
    {
        $this->pdo = new PDOConnection();
    }

    public function inserirVenda(Vendas $venda)
    {
        $sql = "INSERT INTO vendas (id_venda, total_venda, dataVenda, id_cliente, pagamento) VALUES (NULL, :valortotal, :datavenda, :id_cliente, :pagamento)";
        $pdo = $this->pdo->pdo();
        $inserir = $pdo->prepare($sql);
        $inserir->bindValue(':valortotal', $venda->getTotal_venda());
        $inserir->bindValue(':datavenda', $venda->getDataVenda());
        $inserir->bindValue(':id_cliente', $venda->getId_cliente(), PDO::PARAM_INT);
        $inserir->bindValue(':pagamento', $venda->getPagamento());

        if ($inserir->execute()) {
            return $pdo->lastInsertId();
        }

        return false;
    }

    public function adicionarValorTotal(Vendas $venda)
    {
        $sql = "UPDATE vendas SET total_venda = :totalvenda WHERE id_venda = :idvenda";
        $pdo = $this->pdo->pdo();
        $inserir = $pdo->prepare($sql);
        $inserir->bindValue(':totalvenda', $venda->getTotal_venda());
        $inserir->bindValue(':idvenda', $venda->getId_venda());

        if ($inserir->execute()) {
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
