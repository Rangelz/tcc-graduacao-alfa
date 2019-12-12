<?php

declare(strict_types=1);

namespace App\Service\Categoria;

use App\Entity\Categorias;
use App\Repository\CategoriaRepository;

class CategoriaService
{
    /**
     * @var CategoriaRepository
     */
    private $CategoriaRepository;

    public function __construct()
    {
        $this->CategoriaRepository = new CategoriaRepository();
    }

    public function inserir(Categorias $Categoria)
    {
         return $this->CategoriaRepository->inserirCategoria($Categoria);
    }

    public function excluir(Categorias $Categoria)
    {
         return $this->CategoriaRepository->excluirCategoria($Categoria);
    }

    public function editar(Categorias $Categoria)
    {
         return $this->CategoriaRepository->editarCategoria($Categoria);
    }

    public function listar()
    {
         return $this->CategoriaRepository->buscarTodosCategorias();
    }
}