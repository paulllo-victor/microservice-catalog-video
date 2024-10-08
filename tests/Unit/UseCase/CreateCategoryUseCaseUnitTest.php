<?php

namespace Tests\Unit\UseCase;

use Core\Domain\Entity\Category;
use Core\Domain\Repoisory\CategoryRepositoryInterface;
use Core\UseCase\Category\CreateCategoryUseCase;
use Core\UseCase\DTO\Category\CategoryCreateInputDto;
use Core\UseCase\DTO\Category\CategoryCreateOutputDto;
use Mockery;
use PHPUnit\Framework\TestCase;
use Ramsey\Uuid\Uuid;
use stdClass;

class CreateCategoryUseCaseUnitTest extends TestCase{
    public function testCreateNewCategory() {
        $uuid = (string) Uuid::uuid4()->toString();
        $categoryName = 'car';

        $this->mockEntity = Mockery::mock(Category::class,[
            $uuid,
            $categoryName
        ]);

        $this->mockEntity->shouldReceive('id')->andReturn($uuid);

        $this->mockRepo = Mockery::mock(stdClass::class,CategoryRepositoryInterface::class);
        $this->mockRepo->shouldReceive('insert')->andReturn($this->mockEntity);

        $this->mockInputDto = Mockery::mock(CategoryCreateInputDto::class,[
            $uuid,
            $categoryName
        ]);

        $useCase = new CreateCategoryUseCase($this->mockRepo);
        $responseUseCase = $useCase->execute($this->mockInputDto);
        
        
        $this->assertInstanceOf(CategoryCreateOutputDto::class,$responseUseCase);
        $this->assertEquals($responseUseCase->name,$categoryName);
        $this->assertEquals($responseUseCase->description,'');
        Mockery::close();
    }
}