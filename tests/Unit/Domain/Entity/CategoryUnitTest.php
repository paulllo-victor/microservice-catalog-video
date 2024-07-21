<?php


namespace Tests\Unit\Domain\Entity;

use Core\Domain\Entity\Category;
use Core\Domain\Entity\Exception\EntityValidationException;
use PHPUnit\Framework\TestCase;

class CategoryUnitTest extends TestCase{
    public function testAttributes(){
        $category = new Category(
            name: 'New cat',
            description: 'New desc',
            isActive: true
        );

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
        try {
            new Category(
                name: 'Ne'
            );

            $this->assertTrue(false);
        } catch (\Throwable $th) {
            $this->assertInstanceOf(EntityValidationException::class, $th);
        }
    }
}