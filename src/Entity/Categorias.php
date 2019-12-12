<?php 
namespace App\Entity;
class Categorias{
    private $id_categoria;
    private $nome_categoria;    

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
     * Get the value of nome_categoria
     */ 
    public function getNome_categoria()
    {
        return $this->nome_categoria;
    }

    /**
     * Set the value of nome_categoria
     *
     * @return  self
     */ 
    public function setNome_categoria($nome_categoria)
    {
        $this->nome_categoria = $nome_categoria;

        return $this;
    }

}
