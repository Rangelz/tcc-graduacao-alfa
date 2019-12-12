<?php

namespace App\Entity;

class Produtos_vendas
{
    private $id_produtos_vendas;
    private $id_produto;
    private $id_venda;
    private $quantidade;
    private $valor_total;
    private $valor_unitario;
    
    /**
     * Get the value of id_produtos_vendas
     */ 
    public function getId_produtos_vendas()
    {
        return $this->id_produtos_vendas;
    }

    /**
     * Set the value of id_produtos_vendas
     *
     * @return  self
     */ 
    public function setId_produtos_vendas($id_produtos_vendas)
    {
        $this->id_produtos_vendas = $id_produtos_vendas;

        return $this;
    }

    /**
     * Get the value of id_produto
     */ 
    public function getId_produto()
    {
        return $this->id_produto;
    }

    /**
     * Set the value of id_produto
     *
     * @return  self
     */ 
    public function setId_produto($id_produto)
    {
        $this->id_produto = $id_produto;

        return $this;
    }

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
     * Get the value of quantidade
     */ 
    public function getQuantidade()
    {
        return $this->quantidade;
    }

    /**
     * Set the value of quantidade
     *
     * @return  self
     */ 
    public function setQuantidade($quantidade)
    {
        $this->quantidade = $quantidade;

        return $this;
    }

    /**
     * Get the value of valor_total
     */ 
    public function getValor_total()
    {
        return $this->valor_total;
    }

    /**
     * Set the value of valor_total
     *
     * @return  self
     */ 
    public function setValor_total($valor_total)
    {
        $this->valor_total = $valor_total;

        return $this;
    }

    /**
     * Get the value of valor_unitario
     */ 
    public function getValor_unitario()
    {
        return $this->valor_unitario;
    }

    /**
     * Set the value of valor_unitario
     *
     * @return  self
     */ 
    public function setValor_unitario($valor_unitario)
    {
        $this->valor_unitario = $valor_unitario;

        return $this;
    }
}
