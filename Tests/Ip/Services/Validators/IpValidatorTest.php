<?php

/**
 * @package     valueobjects
 * @since       09.08.2022 - 12:53
 * @author      Patrick Froch <info@easySolutionsIT.de>
 * @see         http://easySolutionsIT.de
 * @copyright   e@sy Solutions IT 2022
 * @license     LGPL
 */

declare(strict_types=1);

namespace Esit\Valueobjects\Tests\Ip\Services\Validators;

use Esit\Valueobjects\Classes\Ip\Services\Validators\IpValidator;
use PHPUnit\Framework\TestCase;

class IpValidatorTest extends TestCase
{

    /**
     * @var IpValidator
     */
    private IpValidator $validator;


    protected function setUp(): void
    {
        $this->validator = new IpValidator();
    }


    public function testIsValidReturnTrueIfIpIsMinNumber(): void
    {
        self::assertTrue($this->validator->isValid('0.0.0.0'));
    }


    public function testIsValidReturnTrueIfIpIsMaxNumber(): void
    {
        self::assertTrue($this->validator->isValid('255.255.255.255'));
    }


    public function testIsValidReturnTrueIfIpIsLocalHost(): void
    {
        self::assertTrue($this->validator->isValid('127.0.0.1'));
    }


    public function testIsValidReturnTrueIfIpIsLocalIp(): void
    {
        self::assertTrue($this->validator->isValid('192.168.0.1'));
    }


    public function testIsValidReturnFalseIfOneNumberIsTooHeigh(): void
    {
        self::assertFalse($this->validator->isValid('8.256.8.8'));
    }


    public function testIsValidReturnFalseIfIpContainsAChar(): void
    {
        self::assertFalse($this->validator->isValid('8.A.8.8'));
    }


    public function testIsValidReturnFalseIfIpContainsASign(): void
    {
        self::assertFalse($this->validator->isValid('8.8-8.8.8'));
    }
}
