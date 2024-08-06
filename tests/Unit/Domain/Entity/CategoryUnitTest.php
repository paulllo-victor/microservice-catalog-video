<?php


namespace Tests\Unit\Domain\Entity;

use Core\Domain\Entity\Category;
use Core\Domain\Exception\EntityValidationException;
use PHPUnit\Framework\TestCase;
use Ramsey\Uuid\Uuid;

class CategoryUnitTest extends TestCase{
    public function testAttributes(){
        $category = new Category(
            name: 'New cat',
            description: 'New desc',
            isActive: true
        );

        $this->assertNotEmpty($category->createdAt());
        $this->assertNotEmpty($category->id());
        $this->assertEquals("New cat", $category->name);
        $this->assertEquals("New desc", $category->description);
        $this->assertEquals(true, $category->isActive);
    }

    public function testActivated(){
        $category = new Category(
            name: 'New cat',
            isActive: false
        );

        $this->assertFalse($category->isActive);
        $category->activate();
        $this->assertTrue($category->isActive);
    }

    public function testDisabled(){
        $category = new Category(
            name: 'New cat'
        );

        $this->assertTrue($category->isActive);
        $category->disable();
        $this->assertFalse($category->isActive);
    }
    public function testUpdate(){
        $uuid = (string) Uuid::uuid4()->toString();
        $category = new Category(
            id: $uuid,
            name: 'New Cat',
            description: "New desc" ,
            isActive: true,
            createdAt: '2024-01-01 12:12:12'
        );

        $category->update(
            name: 'Cat New',
            description: "Desc New" ,
        );

        $this->assertEquals($uuid,$category->id());
        $this->assertEquals("Cat New", $category->name);
        $this->assertEquals("Desc New", $category->description);
    }
    
    public function testExceptionName(){
        try {
            new Category(
                name: 'N'
            );

            $this->assertTrue(false);
        } catch (\Throwable $th) {
            $this->assertInstanceOf(EntityValidationException::class, $th);
        }
    }

    public function testExceptionDescription(){
        try {
            new Category(
                name: 'New category',
                description: random_bytes(9999),
            );

            $this->assertTrue(false);
        } catch (\Throwable $th) {
            $this->assertInstanceOf(EntityValidationException::class, $th);
        }
    }
}