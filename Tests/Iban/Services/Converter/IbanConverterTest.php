<?php

/**
 * @package     valueobjects
 * @version     1.0.0
 * @since       18.09.22 - 18:47
 * @author      Patrick Froch <info@easySolutionsIT.de>
 * @see         http://easySolutionsIT.de
 * @copyright   e@sy Solutions IT 2022
 * @license     EULA
 */

declare(strict_types=1);

namespace Esit\Valueobjects\Tests\Iban\Services\Converter;

use Esit\Valueobjects\Classes\Iban\Services\Converter\IbanConverter;
use PHPUnit\Framework\TestCase;

class IbanConverterTest extends TestCase
{


    public function testConvertToFormatedReturnStringWithoutSpaces(): void
    {
        $iban       = 'DE12 3456 7890 1234 5678 90';
        $expected   = \str_replace(' ', '', $iban);
        $converter  = new IbanConverter();
        self::assertSame($expected, $converter->convertToIban($iban));
    }


    public function testConvertToIban(): void
    {
        $iban       = 'DE12345678901234567890';
        $expected   = 'DE12 3456 7890 1234 5678 90';
        $converter  = new IbanConverter();
        self::assertSame($expected, $converter->convertToFormated($iban));
    }
}
