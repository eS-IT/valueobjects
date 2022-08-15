<?php

/**
 * @package     valueobjects
 * @since       03.08.2022 - 10:34
 * @author      Patrick Froch <info@easySolutionsIT.de>
 * @see         http://easySolutionsIT.de
 * @copyright   e@sy Solutions IT 2022
 * @license     LGPL
 */

declare(strict_types=1);

namespace Esit\Valueobjects\Tests\Money\Services\Validators;

use Esit\Valueobjects\Classes\Money\Exceptions\ParameterIsEmptyException;
use Esit\Valueobjects\Classes\Money\Services\Validators\MoneyValidator;
use PHPUnit\Framework\TestCase;

final class MoneyValidatorTest extends TestCase
{

    /**
     * @var MoneyValidator
     */
    private MoneyValidator $validator;


    protected function setUp(): void
    {
        $this->validator = new MoneyValidator();
    }


    public function testIsValidMonyStringReturnFalseIfSeperatorIsNotRight(): void
    {
        self::assertFalse($this->validator->isValidString('1.000,00', '-', ','));
    }


    public function testIsValidMonyStringReturnFalseIfDecimalIsNotRight(): void
    {
        self::assertFalse($this->validator->isValidString('1.000,00', '.', '-'));
    }


    public function testIsValidMonyStringReturnFalseIfDecimalPlacesIsNotRight(): void
    {
        self::assertFalse($this->validator->isValidString('1.000,00', '.', ',', 3));
    }


    public function testIsValidMonyStringReturnTrueWithIndividualSigns(): void
    {
        self::assertTrue($this->validator->isValidString('1|000-0000', '|', '-', 4));
    }


    public function testIsValidMonyStringReturnFalseIfThereAreLetters(): void
    {
        self::assertFalse($this->validator->isValidString('1.0T0,00'));
    }


    public function testIsValidMonyStringThrowExceptionIfValueIsEmpty(): void
    {
        $this->expectException(ParameterIsEmptyException::class);
        $this->expectExceptionMessage('value could not be empty');
        self::assertFalse($this->validator->isValidString(''));
    }


    public function testIsValidMonyStringThrowExceptionIfDecimalSignIsEmpty(): void
    {
        $this->expectException(ParameterIsEmptyException::class);
        $this->expectExceptionMessage('decimal char could not be empty');
        self::assertFalse($this->validator->isValidString('1.000,00', '.', '', 2));
    }


    public function testIsValidMonyStringDoNotThrowExceptionIfDecimalSignIsEmptyAndDecimalPlacesAreZero(): void
    {
        self::assertTrue($this->validator->isValidString('1.000', '.', '', 0));
    }


    public function testIsValidMonyStringReturnTrueWithStandardSigns(): void
    {
        self::assertTrue($this->validator->isValidString('1.000,00'));
    }


    public function testIsValidMonyStringReturnTrueWithoutASeperator(): void
    {
        self::assertTrue($this->validator->isValidString('1000,00', '', ',', 2));
    }


    public function testIsValidMonyStringReturnTrueWithZeroDecimalPlaces(): void
    {
        self::assertTrue($this->validator->isValidString('1.000', '.', ',', 0));
    }


    public function testIsValidMonyStringReturnFalseWithTwoDecimalPlaces(): void
    {
        self::assertFalse($this->validator->isValidString('1.000', '.', ',', 2));
    }


    public function testIsValidMonyStringReturnTrueWithoutSigns(): void
    {
        self::assertTrue($this->validator->isValidString('1000', '', ',', 0));
    }


    public function testIsValidMonyStringReturnFalseIfThereAreTooManyDecimalPlaces(): void
    {
        self::assertFalse($this->validator->isValidString('1000,00', '', ',', 0));
    }


    public function testIsValidIntReturnTrueIfValueIsGreaterThenZero(): void
    {
        self::assertTrue($this->validator->isValidInt(1));
    }


    public function testIsValidIntReturnTrueIfValueIsZero(): void
    {
        self::assertTrue($this->validator->isValidInt(0));
    }


    public function testIsValidIntReturnFalseIfValueIsLessZero(): void
    {
        self::assertFalse($this->validator->isValidInt(-1));
    }
}
