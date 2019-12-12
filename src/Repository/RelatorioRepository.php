<?php

declare(strict_types=1);

namespace App\Repository;

use App\Connection\PDOConnection;
use PDO;


class RelatorioRepository
{
    /**
     * @var PDOConnection
     */
    private $pdo;

    public function __construct()
    {
        $this->pdo = new PDOConnection();
    }

    public function gerarRelatorioClientes($cpf, $nome)
    {
        $sql = "SELECT
                c.id_cliente,
                c.nome,
                c.sobrenome,
                c.endereco,
                c.email,
                c.telefone,
                c.cpf,
                SUM(total_venda) AS total,
                COUNT(1) as quantidade
            FROM clientes c
            left join vendas v on c.id_cliente = v.id_cliente 
            WHERE
                (:cpf = '' or c.cpf = :cpf)
                and
                (
                    :nome = '%%'
                    or upper(c.nome) like upper(:nome)
                    or upper(c.sobrenome) like upper(:nome)
                )
            GROUP by 1, 2, 3, 4, 5, 6, 7 
            ORDER by c.nome";

        $consulta = $this->pdo->pdo()->prepare($sql);
        $consulta->bindValue("cpf", $cpf);
        $consulta->bindValue("nome", "%$nome%");
        $consulta->execute();

        $dados = $consulta->fetchAll();

        return $dados;
    }

    public function gerarRelatorioProdutos($codigo, $descricao, $sem_estoque, $categoria)
    {
        $sql = "
                SELECT
                    p.id_produto,
                    p.nome,
                    p.quantidade,
                    c.nome_categoria,
                    p.preco,
                    sum(pv.quantidade) as quantidade_total_venda,
                    sum(pv.valor_total) as valor_total_venda
                from produtos p
                inner join categorias c on p.id_categoria = c.id_categoria
                left join produtos_vendas pv on pv.id_produto = p.id_produto
                where 
                    (:codigo = 0 or p.id_produto = :codigo)
                    and (:categoria = 0 or p.id_categoria = :categoria)
                    and (:descricao = '%%' or p.nome like :descricao)
                    and (:sem_estoque is false or p.quantidade <= 0)
                group by 1, 2, 3, 4
                order by p.nome asc";

        $consulta = $this->pdo->pdo()->prepare($sql);
        $consulta->bindValue("codigo", $codigo);
        $consulta->bindValue("descricao", "%$descricao%");
        $consulta->bindValue("sem_estoque", $sem_estoque, PDO::PARAM_BOOL);
        $consulta->bindValue("categoria", $categoria);
        $consulta->execute();

        $dados = $consulta->fetchAll();

        return $dados;
    }

    public function gerarRelatorioVendas($cpf, $tipopagamento, $datainicial, $datafinal)
    {
        $sql = "SELECT 
                v.id_venda,
                v.dataVenda,
                v.pagamento,
                c.cpf,
                concat(c.nome,' ', c.sobrenome) as cliente,
                v.total_venda,
                sum(pv.quantidade) as quantidade_total
            FROM vendas v
            inner join clientes c on c.id_cliente = v.id_cliente
            inner join produtos_vendas pv on v.id_venda = pv.id_venda
            where 
                (:cpf = '' or c.cpf = :cpf)
                and (:tipopagamento = '' or v.pagamento = :tipopagamento)
                and v.dataVenda between :datainicial and :datafinal
            group by 1, 2, 3, 4, 5
            order by dataVenda";

        $consulta = $this->pdo->pdo()->prepare($sql);
        $consulta->bindValue("cpf", $cpf);
        $consulta->bindValue("tipopagamento", $tipopagamento);
        $consulta->bindValue("datainicial", $datainicial);
        $consulta->bindValue("datafinal", $datafinal);
        $consulta->execute();

        $dados = $consulta->fetchAll();

        return $dados;
    }
}
