<?php

namespace Tests\Unit\Domain\Validation;

use Core\Domain\Exception\EntityValidationException;
use PHPUnit\Framework\TestCase;
use Core\Domain\Validation\DomainValidation;
use Throwable;

class DomainVdalitionUnitTest extends TestCase{
    public function testNotNull(){
        try {
            $value = '';
            DomainValidation::notNull($value);
            $this->assertTrue(false);
        } catch (Throwable $th) {
            $this->assertInstanceOf(EntityValidationException::class, $th);
        }
    }

    public function testNotNullCutomMessageException(){
        $messageError = "customer message error";
        try {
            $value = '';
            DomainValidation::notNull($value, $messageError);
            $this->assertTrue(false);
        } catch (Throwable $th) {
            $this->assertInstanceOf(EntityValidationException::class, $th,$messageError);
        }
    }

    public function testStrMaxLength(){
        $messageError = "customer message error";
        try {
            $value = 'Teste';
            DomainValidation::strMaxLength($value, 3, $messageError);
            $this->assertTrue(false);
        } catch (Throwable $th) {
            $this->assertInstanceOf(EntityValidationException::class, $th,$messageError,  $messageError);
        }
    }
    public function testStrMinLength(){
        $messageError = "customer message error";
        try {
            $value = 'Teste';
            DomainValidation::strMinLength($value, 8, $messageError);
            $this->assertTrue(false);
        } catch (Throwable $th) {
            $this->assertInstanceOf(EntityValidationException::class, $th,$messageError,  $messageError);
        }
    }

    public function testStrCanNullAndMaxLength(){
        $messageError = "customer message error";
        try {
            $value = 'teste';
            DomainValidation::strCanNullAndMaxLength($value, 3, $messageError);
            $this->assertTrue(false);
        } catch (Throwable $th) {
            $this->assertInstanceOf(EntityValidationException::class, $th,$messageError,  $messageError);
        }
    }
}