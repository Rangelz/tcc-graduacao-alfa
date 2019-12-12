<?php

namespace App\Entity;

class Produtos
{
    private $id_produto;
    private $imagem;
    private $nome;
    private $quantidade;
    private $preco;
    private $id_categoria;
    private $id_fornecedor;

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
     * Get the value of imagem
     */ 
    public function getImagem()
    {
        return $this->imagem;
    }

    /**
     * Set the value of imagem
     *
     * @return  self
     */ 
    public function setImagem($imagem)
    {
        $this->imagem = $imagem;

        return $this;
    }

    /**
     * Get the value of nome
     */ 
    public function getNome()
    {
        return $this->nome;
    }

    /**
     * Set the value of nome
     *
     * @return  self
     */ 
    public function setNome($nome)
    {
        $this->nome = $nome;

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
     * Get the value of preco
     */ 
    public function getPreco()
    {
        return $this->preco;
    }

    /**
     * Set the value of preco
     *
     * @return  self
     */ 
    public function setPreco($preco)
    {
        $this->preco = $preco;

        return $this;
    }

    /**
     * Get the value of id_categoria
     */ 
    public function getId_categoria()
    {
        return $this->id_categoria;
    }

    /**
     * Set the value of id_categoria
     *
     * @return  self
     */ 
    public function setId_categoria($id_categoria)
    {
        $this->id_categoria = $id_categoria;

        return $this;
    }

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
}