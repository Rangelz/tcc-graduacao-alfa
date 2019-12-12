<?php

namespace App\Entity;

class Vendas
{
    private $id_venda;
    private $total_venda;
    private $dataVenda;
    private $id_cliente;
    private $pagamento;

    /**
     * Get the value of id_venda
     */ 
    public function getId_venda()
    {
        return $this->id_venda;
    }

    /**
     * Set the value of id_venda
     *
     * @return  self
     */ 
    public function setId_venda($id_venda)
    {
        $this->id_venda = $id_venda;

        return $this;
    }

    /**
     * Get the value of total_venda
     */ 
    public function getTotal_venda()
    {
        return $this->total_venda;
    }

    /**
     * Set the value of total_venda
     *
     * @return  self
     */ 
    public function setTotal_venda($total_venda)
    {
        $this->total_venda = $total_venda;

        return $this;
    }

    /**
     * Get the value of dataVenda
     */ 
    public function getDataVenda()
    {
        return $this->dataVenda;
    }

    /**
     * Set the value of dataVenda
     *
     * @return  self
     */ 
    public function setDataVenda($dataVenda)
    {
        $this->dataVenda = $dataVenda;

        return $this;
    }

    /**
     * Get the value of id_cliente
     */ 
    public function getId_cliente()
    {
        return $this->id_cliente;
    }

    /**
     * Set the value of id_cliente
     *
     * @return  self
     */ 
    public function setId_cliente($id_cliente)
    {
        $this->id_cliente = $id_cliente;

        return $this;
    }

    /**
     * Get the value of pagamento
     */ 
    public function getPagamento()
    {
        return $this->pagamento;
    }

    /**
     * Set the value of pagamento
     *
     * @return  self
     */ 
    public function setPagamento($pagamento)
    {
        $this->pagamento = $pagamento;

        return $this;
    }
}
