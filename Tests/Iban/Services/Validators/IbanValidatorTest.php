<?php
/**
 * @package     valueobjects
 * @version     1.0.0
 * @since       19.09.22 - 13:40
 * @author      Patrick Froch <info@easySolutionsIT.de>
 * @see         http://easySolutionsIT.de
 * @copyright   e@sy Solutions IT 2022
 * @license     EULA
 */
namespace Esit\Valueobjects\Tests\Iban\Services\Validators;

use Esit\Valueobjects\Classes\Iban\Services\Validators\IbanValidator;
use PHPUnit\Framework\TestCase;

class IbanValidatorTest extends TestCase
{

    private IbanValidator $validator;


    protected function setUp(): void
    {
        $this->validator = new IbanValidator();
    }


    public function testIsValidReturnTrueIfIbanIsValidWithoutSpaces(): void
    {
        self::assertTrue($this->validator->isValid('DE12345678901234567890'));
    }


    public function testIsValidReturnFalseIfIbanHasSpaces(): void
    {
        self::assertFalse($this->validator->isValid('DE12 3456 7890 1234 5678 90'));
    }


    public function testIsValidReturnFalseIfIbanHasNoCounty(): void
    {
        self::assertFalse($this->validator->isValid('9012345678901234567890'));
    }


    public function testIsValidReturnFalseIfIbanHasNoNumbers(): void
    {
        self::assertFalse($this->validator->isValid('testTESTtestTETStestTEST'));
    }
}
