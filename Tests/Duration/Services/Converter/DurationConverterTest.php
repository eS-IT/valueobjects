<?php

/**
 * @package     valueobjects
 * @since       12.03.2024 - 12:54
 * @author      Patrick Froch <info@easySolutionsIT.de>
 * @see         http://easySolutionsIT.de
 * @copyright   e@sy Solutions IT 2024
 * @license     LGPL
 */

declare(strict_types=1);

namespace Esit\Valueobjects\Tests\Duration\Services\Converter;

use Esit\Valueobjects\Classes\Duration\Services\Converter\DurationConverter;
use Esit\Valueobjects\Classes\Duration\Valueobjects\DurationValue;
use Esit\Valueobjects\Classes\Duration\Valueobjects\HourValue;
use Esit\Valueobjects\Classes\Duration\Valueobjects\MinuteValue;
use Esit\Valueobjects\Classes\Duration\Valueobjects\SecondValue;
use PHPUnit\Framework\TestCase;

class DurationConverterTest extends TestCase
{

    private DurationConverter $converter;


    protected function setUp(): void
    {
        $this->converter = new DurationConverter();
    }


    public function testConvertToFormatedHoursReturnUnmodifiedHoursIfHoursIsGreaterThenTen(): void
    {
        $time   = 12;

        $hour   = $this->getMockBuilder(HourValue::class)
                       ->disableOriginalConstructor()
                       ->getMock();

        $hour->expects(self::once())
             ->method('count')
             ->willReturn($time);

        $this->assertSame((string)$time, $this->converter->convertToFormatedHours($hour));
    }


    public function testConvertToFormatedHoursAddZeroIfHoursIslessThenTen(): void
    {
        $time   = 8;

        $hour   = $this->getMockBuilder(HourValue::class)
                       ->disableOriginalConstructor()
                       ->getMock();

        $hour->expects(self::once())
             ->method('count')
             ->willReturn($time);

        $this->assertSame("0$time", $this->converter->convertToFormatedHours($hour));
    }


    public function testConvertToFormatedMinutesReturnUnmodifiedMinutesIfMinutesIsGreaterThenTen(): void
    {
        $time   = 12;

        $minute = $this->getMockBuilder(MinuteValue::class)
                       ->disableOriginalConstructor()
                       ->getMock();

        $minute->expects(self::once())
               ->method('count')
               ->willReturn($time);

        $this->assertSame((string)$time, $this->converter->convertToFormatedMinutes($minute));
    }


    public function testConvertToFormatedMinutesReturnUnmodifiedMinutesIfMinutesIsLessThenTen(): void
    {
        $time   = 8;

        $minute = $this->getMockBuilder(MinuteValue::class)
                       ->disableOriginalConstructor()
                       ->getMock();

        $minute->expects(self::once())
               ->method('count')
               ->willReturn($time);

        $this->assertSame("0$time", $this->converter->convertToFormatedMinutes($minute));
    }


    public function testConvertToFormatedSecondsReturnUnmodifiedSecondsIfSecondsIsGreaterThenTen(): void
    {
        $time       = 12;

        $seconds    = $this->getMockBuilder(SecondValue::class)
                           ->disableOriginalConstructor()
                           ->getMock();

        $seconds->expects(self::once())
                ->method('value')
                ->willReturn($time);

        $this->assertSame((string)$time, $this->converter->convertToFormatedSeconds($seconds));
    }


    public function testConvertToFormatedSecondsReturnUnmodifiedSecondsIfSecondsIsLessThenTen(): void
    {
        $time       = 8;

        $seconds    = $this->getMockBuilder(SecondValue::class)
                           ->disableOriginalConstructor()
                           ->getMock();

        $seconds->expects(self::once())
                ->method('value')
                ->willReturn($time);

        $this->assertSame("0$time", $this->converter->convertToFormatedSeconds($seconds));
    }


    public function testConvertToFormatedString(): void
    {
        $expected   = 12;
        $duration   = $this->getMockBuilder(DurationValue::class)
                           ->disableOriginalConstructor()
                           ->getMock();

        $hour       = $this->getMockBuilder(HourValue::class)
                           ->disableOriginalConstructor()
                           ->getMock();

        $minutes    = $this->getMockBuilder(MinuteValue::class)
                           ->disableOriginalConstructor()
                           ->getMock();

        $secondes   = $this->getMockBuilder(SecondValue::class)
                           ->disableOriginalConstructor()
                           ->getMock();

        $duration->expects(self::once())
                 ->method('isNegativ')
                 ->willReturn(false);

        $duration->expects(self::once())
                 ->method('getHoursValue')
                 ->willReturn($hour);

        $duration->expects(self::once())
                 ->method('getMinutesValue')
                 ->willReturn($minutes);

        $duration->expects(self::once())
                 ->method('getSecondsValue')
                 ->willReturn($secondes);

        $hour->expects(self::once())
             ->method('count')
             ->willReturn($expected);

        $minutes->expects(self::once())
                ->method('count')
                ->willReturn($expected);

        $secondes->expects(self::once())
                 ->method('value')
                 ->willReturn($expected);

        $this->assertSame("12:12:12", $this->converter->convertToFormatedString($duration, 'H:i:s'));
    }
}
