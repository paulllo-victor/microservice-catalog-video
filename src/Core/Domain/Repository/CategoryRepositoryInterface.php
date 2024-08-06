<?php

namespace Core\Domain\Repoisory;

use Core\Domain\Entity\Category;

interface CategoryRepositoryInterface{
    public function insert(Category $category) : Category;
    public function findById(string $id) : Category;
    public function findAll(string $filter = '', $order = "DESC") : Array;
    public function paginate(string $filter = '', $order = "DESC", int $page = 1, int $totalPage = 15) : Array;
    public function update(Category $category) : Category;
    public function delete(string $id) : bool;
    public function toCategory(object $data) : Category;
}