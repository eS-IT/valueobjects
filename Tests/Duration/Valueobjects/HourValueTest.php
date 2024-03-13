<?php

/**
 * @package     valueobjects
 * @since       12.03.2024 - 12:16
 * @author      Patrick Froch <info@easySolutionsIT.de>
 * @see         http://easySolutionsIT.de
 * @copyright   e@sy Solutions IT 2024
 * @license     LGPL
 */

declare(strict_types=1);

namespace Duration\Valueobjects;

use Esit\Valueobjects\Classes\Duration\Services\Converter\DurationConverter;
use Esit\Valueobjects\Classes\Duration\Services\Helper\DurationDivider;
use Esit\Valueobjects\Classes\Duration\Valueobjects\HourValue;
use PHPUnit\Framework\MockObject\MockObject;
use PHPUnit\Framework\TestCase;

class HourValueTest extends TestCase
{


    /**
     * @var (DurationDivider&MockObject)|MockObject
     */
    private $divider;


    /**
     * @var (DurationConverter&MockObject)|MockObject
     */
    private $converter;


    /**
     * @var int
     */
    private $time = 0;


    /**
     * @var HourValue
     */
    private HourValue $hourValue;


    protected function setUp(): void
    {
        $this->divider      = $this->getMockBuilder(DurationDivider::class)
                                   ->disableOriginalConstructor()
                                   ->getMock();

        $this->converter    = $this->getMockBuilder(DurationConverter::class)
                                   ->disableOriginalConstructor()
                                   ->getMock();

        $this->time         = \time();

        $this->divider->method('getScondsOfHours')
                      ->willReturn($this->time);

        $this->hourValue    = new HourValue($this->time, $this->divider, $this->converter);
    }


    public function testGetHours(): void
    {
        $expected = 12;

        $this->divider->expects(self::once())
                      ->method('getHoursCount')
                      ->with($this->time)
                      ->willReturn($expected);

        $this->assertSame($expected, $this->hourValue->count());
    }


    public function testGetSecondsOfHours(): void
    {
        $this->assertSame($this->time, $this->hourValue->value());
    }


    public function testGetFormatesHours(): void
    {
        $expected = "09";

        $this->converter->expects(self::once())
                        ->method('convertToFormatedHours')
                        ->with($this->hourValue)
                        ->willReturn($expected);

        $this->assertSame($expected, $this->hourValue->parse());
    }
}
