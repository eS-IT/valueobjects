<?php

/**
 * @package     valueobjects
 * @since       12.03.2024 - 12:39
 * @author      Patrick Froch <info@easySolutionsIT.de>
 * @see         http://easySolutionsIT.de
 * @copyright   e@sy Solutions IT 2024
 * @license     LGPL
 */

declare(strict_types=1);

namespace Esit\Valueobjects\Tests\Duration\Valueobjects;

use Esit\Valueobjects\Classes\Duration\Services\Converter\DurationConverter;
use Esit\Valueobjects\Classes\Duration\Services\Helper\DurationDivider;
use Esit\Valueobjects\Classes\Duration\Valueobjects\SecondValue;
use PHPUnit\Framework\MockObject\MockObject;
use PHPUnit\Framework\TestCase;

class SecondValueTest extends TestCase
{


    /**
     * @var int
     */
    private int $time;


    /**
     * @var (DurationDivider&MockObject)|MockObject
     */
    private $divider;


    /**
     * @var (DurationConverter&MockObject)|MockObject
     */
    private $converter;


    /**
     * @var SecondValue
     */
    private SecondValue $secondValue;


    protected function setUp(): void
    {
        $this->time         = \time();

        $this->divider      = $this->getMockBuilder(DurationDivider::class)
                                   ->disableOriginalConstructor()
                                   ->getMock();

        $this->converter    = $this->getMockBuilder(DurationConverter::class)
                                   ->disableOriginalConstructor()
                                   ->getMock();

        $this->divider->method('getSconds')
                      ->willReturn($this->time);

        $this->secondValue  = new SecondValue($this->time, $this->divider, $this->converter);
    }


    public function testGetSeconds(): void
    {
        $this->assertSame($this->time, $this->secondValue->value());
    }


    public function testGetFormatesSeconds(): void
    {
        $expected = "09";

        $this->converter->expects(self::once())
                        ->method('convertToFormatedSeconds')
                        ->with($this->secondValue)
                        ->willReturn($expected);

        $this->assertSame($expected, $this->secondValue->parse());
    }
}
