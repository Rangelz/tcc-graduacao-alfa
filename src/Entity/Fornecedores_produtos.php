<?php

namespace App\Entity;

class Fornecedores_produtos
{
    private $id_fornecedor;
    private $id_produto;
    private $custo;

    /**
     * Get the value of id_fornecedor
     */
    public function getId_fornecedor()
    {
        return $this->id_fornecedor;
    }

    /**
     * Set the value of id_fornecedor
     *
     * @return  self
     */
    public function setId_fornecedor($id_fornecedor)
    {
        $this->id_fornecedor = $id_fornecedor;

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
     * Get the value of custo
     */ 
    public function getCusto()
    {
        return $this->custo;
    }

    /**
     * Set the value of custo
     *
     * @return  self
     */ 
    public function setCusto($custo)
    {
        $this->custo = $custo;

        return $this;
    }
}
