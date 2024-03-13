<?php

/**
 * @package     valueobjects
 * @since       12.03.2024 - 12:29
 * @author      Patrick Froch <info@easySolutionsIT.de>
 * @see         http://easySolutionsIT.de
 * @copyright   e@sy Solutions IT 2024
 * @license     LGPL
 */

declare(strict_types=1);

namespace Esit\Valueobjects\Tests\Duration\Valueobjects;

use Esit\Valueobjects\Classes\Duration\Services\Converter\DurationConverter;
use Esit\Valueobjects\Classes\Duration\Services\Helper\DurationDivider;
use Esit\Valueobjects\Classes\Duration\Valueobjects\MinuteValue;
use PHPUnit\Framework\MockObject\MockObject;
use PHPUnit\Framework\TestCase;

class MinuteValueTest extends TestCase
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
     * @var MinuteValue
     */
    private MinuteValue $minuteValue;


    protected function setUp(): void
    {
        $this->time         = \time();

        $this->divider      = $this->getMockBuilder(DurationDivider::class)
                                   ->disableOriginalConstructor()
                                   ->getMock();

        $this->converter    = $this->getMockBuilder(DurationConverter::class)
                                   ->disableOriginalConstructor()
                                   ->getMock();

        $this->divider->method('getScondsOfMinutes')
                      ->willReturn($this->time);

        $this->minuteValue  = new MinuteValue($this->time, $this->divider, $this->converter);
    }


    public function testGetMinutes(): void
    {
        $expected = 12;

        $this->divider->expects(self::once())
                      ->method('getMinutesCount')
                      ->with($this->time)
                      ->willReturn($expected);

        $this->assertSame($expected, $this->minuteValue->count());
    }


    public function testGetSeconddsOfMinutes(): void
    {
        $this->assertSame($this->time, $this->minuteValue->value());
    }


    public function testGetFormatesMinutes(): void
    {
        $expected = "09";

        $this->converter->expects(self::once())
                        ->method('convertToFormatedMinutes')
                        ->with($this->minuteValue)
                        ->willReturn($expected);

        $this->assertSame($expected, $this->minuteValue->parse());
    }
}
