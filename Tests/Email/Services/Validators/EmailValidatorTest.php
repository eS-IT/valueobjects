<?php

/**
 * @package     valueobjects
 * @since       08.08.2022 - 16:10
 * @author      Patrick Froch <info@easySolutionsIT.de>
 * @see         http://easySolutionsIT.de
 * @copyright   e@sy Solutions IT 2022
 * @license     LGPL
 */

declare(strict_types=1);

namespace Esit\Valueobjects\Tests\Email\Services\Validators;

use Esit\Valueobjects\Classes\Email\Services\Validators\EmailValidator;
use PHPUnit\Framework\TestCase;

class EmailValidatorTest extends TestCase
{

    private EmailValidator $validator;


    protected function setUp(): void
    {
        $this->validator = new EmailValidator();
    }


    public function testisValidReturnTrueIfEmailIsValid(): void
    {
        self::assertTrue($this->validator->isValid('info@example.org'));
    }


    public function testisValidReturnFalseIfEmailEndsWithDot(): void
    {
        self::assertFalse($this->validator->isValid('info@example.org.'));
    }


    public function testisValidReturnFalseIfEmailStartsWithDot(): void
    {
        self::assertFalse($this->validator->isValid('.info@example.org'));
    }


    public function testisValidReturnFalseIfEmailHasNoDotInDomain(): void
    {
        self::assertFalse($this->validator->isValid('info@example-org'));
    }


    public function testisValidReturnFalseIfEmailHasNoAt(): void
    {
        self::assertFalse($this->validator->isValid('info-example.org'));
    }


    public function testisValidReturnFalseIfEmailStartWithAt(): void
    {
        self::assertFalse($this->validator->isValid('@info-example.org'));
    }


    public function testisValidReturnFalseIfEmailEndsWithAt(): void
    {
        self::assertFalse($this->validator->isValid('info-example.org@'));
    }
}
