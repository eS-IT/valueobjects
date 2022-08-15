<?php

/**
 * @package     valueobjects
 * @since       06.08.2022 - 16:42
 * @author      Patrick Froch <info@easySolutionsIT.de>
 * @see         http://easySolutionsIT.de
 * @copyright   e@sy Solutions IT 2022
 * @license     LGPL
 */

declare(strict_types=1);

namespace Esit\Valueobjects\Tests\Isbn\Services\Validators;

use Esit\Valueobjects\Classes\Isbn\Services\Validators\IsbnValidator;
use PHPUnit\Framework\TestCase;

class IsbnValidatorTest extends TestCase
{

    private IsbnValidator $validator;


    protected function setUp(): void
    {
        $this->validator = new IsbnValidator();
    }


    public function testIsValidIsbn13ReturnTureIfStringIsAValidIsbn13WithDashes(): void
    {
        self::assertTrue($this->validator->isValidIsbn13('978-3-86680-192-9'));
    }


    public function testIsValidIsbn13ReturnTureIfStringIsAValidIsbn13WithOneDashes(): void
    {
        self::assertTrue($this->validator->isValidIsbn13('978-3866801929'));
    }


    public function testIsValidIsbn13ReturnTureIfStringIsAValidIsbn13WithoutDashes(): void
    {
        self::assertTrue($this->validator->isValidIsbn13('9783866801929'));
    }


    public function testIsValidIsbn13ReturnFalseIfStringEndsWithADash(): void
    {
        self::assertFalse($this->validator->isValidIsbn13('978386801929-'));
    }


    public function testIsValidIsbn13ReturnFalseIfStringStartsWithADash(): void
    {
        self::assertFalse($this->validator->isValidIsbn13('-978386801929'));
    }


    public function testIsValidIsbn13ReturnFalseIfStringContainsLetters(): void
    {
        self::assertFalse($this->validator->isValidIsbn13('97838S6801929'));
    }


    public function testIsValidIsbn13ReturnFalseIfStringIsTooLong(): void
    {
        self::assertFalse($this->validator->isValidIsbn13('97838666801929'));
    }


    public function testIsValidIsbn13ReturnFalseIfStringIsTooShort(): void
    {
        self::assertFalse($this->validator->isValidIsbn13('97838666801929'));
    }


    public function testValidateCheckSum13ReturnTrueIfChecksumIsRight(): void
    {
        self::assertTrue($this->validator->validateCheckSum13('978-3-86680-192-9'));
        self::assertTrue($this->validator->validateCheckSum13('9783866801929'));
    }


    public function testValidateCheckSum13ReturnFalseIfChecksumIsWrongWithDashes(): void
    {
        self::assertFalse($this->validator->validateCheckSum13('978-3-86680-192-8'));
        self::assertFalse($this->validator->validateCheckSum13('978-3-86680-192-7'));
        self::assertFalse($this->validator->validateCheckSum13('978-3-86680-192-6'));
        self::assertFalse($this->validator->validateCheckSum13('978-3-86680-192-5'));
        self::assertFalse($this->validator->validateCheckSum13('978-3-86680-192-4'));
        self::assertFalse($this->validator->validateCheckSum13('978-3-86680-192-3'));
        self::assertFalse($this->validator->validateCheckSum13('978-3-86680-192-2'));
        self::assertFalse($this->validator->validateCheckSum13('978-3-86680-192-1'));
        self::assertFalse($this->validator->validateCheckSum13('978-3-86680-192-0'));
    }


    public function testValidateCheckSum13ReturnFalseIfChecksumIsWrongWithoutDashes(): void
    {
        self::assertFalse($this->validator->validateCheckSum13('9783866801928'));
        self::assertFalse($this->validator->validateCheckSum13('9783866801927'));
        self::assertFalse($this->validator->validateCheckSum13('9783866801926'));
        self::assertFalse($this->validator->validateCheckSum13('9783866801925'));
        self::assertFalse($this->validator->validateCheckSum13('9783866801924'));
        self::assertFalse($this->validator->validateCheckSum13('9783866801923'));
        self::assertFalse($this->validator->validateCheckSum13('9783866801922'));
        self::assertFalse($this->validator->validateCheckSum13('9783866801921'));
        self::assertFalse($this->validator->validateCheckSum13('9783866801920'));
    }


    public function testValidateCheckSum13ReturnFalseIfStringIsIsbn10(): void
    {
        self::assertFalse($this->validator->validateCheckSum13('3-86680-192-0'));
        self::assertFalse($this->validator->validateCheckSum13('3866801920'));
    }


    public function testIsValidIsbn10ReturnTureIfStringIsAValidIsbn13WithDashes(): void
    {
        self::assertTrue($this->validator->isValidIsbn10('3-86680-192-0'));
    }


    public function testIsValidIsbn10ReturnTureIfStringIsAValidIsbn13WithOneDashes(): void
    {
        self::assertTrue($this->validator->isValidIsbn10('3-866801920'));
    }


    public function testIsValidIsbn10ReturnTureIfStringIsAValidIsbn13WithoutDashes(): void
    {
        self::assertTrue($this->validator->isValidIsbn10('3866801920'));
    }


    public function testIsValidIsbn10ReturnFalseIfStringEndsWithADash(): void
    {
        self::assertFalse($this->validator->isValidIsbn10('3866801920-'));
    }


    public function testIsValidIsbn10ReturnFalseIfStringStartsWithADash(): void
    {
        self::assertFalse($this->validator->isValidIsbn10('-3866801920'));
    }


    public function testIsValidIsbn10ReturnFalseIfStringContainsLetters(): void
    {
        self::assertFalse($this->validator->isValidIsbn10('386S801920'));
    }


    public function testIsValidIsbn10ReturnFalseIfStringIsTooLong(): void
    {
        self::assertFalse($this->validator->isValidIsbn10('38666801920'));
    }


    public function testIsValidIsbn10ReturnFalseIfStringIsTooShort(): void
    {
        self::assertFalse($this->validator->isValidIsbn10('386801920'));
    }


    public function testValidateCheckSum10ReturnTrueIfChecksumIsRightWithDashes(): void
    {
        self::assertTrue($this->validator->validateCheckSum10('3-86680-192-0'));
    }


    public function testValidateCheckSum10ReturnTrueIfChecksumIsRightWithoutDashes(): void
    {
        self::assertTrue($this->validator->validateCheckSum10('3866801920'));
    }


    public function testValidateCheckSum10ReturnTrueIfChecksumIsX(): void
    {
        self::assertTrue($this->validator->validateCheckSum10('3-499-13599-X'));
    }


    public function testValidateCheckSum10ReturnFalseIfStringIsTooShort(): void
    {
        self::assertFalse($this->validator->validateCheckSum10('3-8680-192-1'));
    }


    public function testValidateCheckSum10ReturnFalseIfStringIsTooLong(): void
    {
        self::assertFalse($this->validator->validateCheckSum10('3-866680-192-1'));
    }


    public function testValidateCheckSum10ReturnFalseIfChecksumIsWrongWithDashes(): void
    {
        self::assertFalse($this->validator->validateCheckSum10('3-86680-192-1'));
        self::assertFalse($this->validator->validateCheckSum10('3-86680-192-2'));
        self::assertFalse($this->validator->validateCheckSum10('3-86680-192-3'));
        self::assertFalse($this->validator->validateCheckSum10('3-86680-192-4'));
        self::assertFalse($this->validator->validateCheckSum10('3-86680-192-5'));
        self::assertFalse($this->validator->validateCheckSum10('3-86680-192-6'));
        self::assertFalse($this->validator->validateCheckSum10('3-86680-192-7'));
        self::assertFalse($this->validator->validateCheckSum10('3-86680-192-8'));
        self::assertFalse($this->validator->validateCheckSum10('3-86680-192-9'));
    }


    public function testValidateCheckSum10ReturnFalseIfChecksumIsWrongWithoutDashes(): void
    {
        self::assertFalse($this->validator->validateCheckSum10('3866801921'));
        self::assertFalse($this->validator->validateCheckSum10('3866801922'));
        self::assertFalse($this->validator->validateCheckSum10('3866801923'));
        self::assertFalse($this->validator->validateCheckSum10('3866801924'));
        self::assertFalse($this->validator->validateCheckSum10('3866801925'));
        self::assertFalse($this->validator->validateCheckSum10('3866801926'));
        self::assertFalse($this->validator->validateCheckSum10('3866801927'));
        self::assertFalse($this->validator->validateCheckSum10('3866801928'));
        self::assertFalse($this->validator->validateCheckSum10('3866801929'));
    }
}
