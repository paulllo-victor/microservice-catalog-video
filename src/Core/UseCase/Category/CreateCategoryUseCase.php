<?php

namespace Core\UseCase\Category;

use Core\Domain\Entity\Category;
use Core\Domain\Repoisory\CategoryRepositoryInterface;
use Core\UseCase\DTO\Category\{
    CategoryCreateInputDto,
    CategoryCreateOutputDto
};

class CreateCategoryUseCase{

    protected $repository;
    public function __construct(CategoryRepositoryInterface $repository){
        $this->repository = $repository;
    }

    public function execute(CategoryCreateInputDto $input) : CategoryCreateOutputDto{
        $category = new Category(
            name: $input->name,
            description: $input->description,
            isActive: $input->isActive,
        );
    
        $category = $this->repository->insert($category);

        return new CategoryCreateOutputDto(
            id: $category->id(),
            name: $category->name,
            description: $category->description,
            is_active: $category->isActive
        );
    }
}