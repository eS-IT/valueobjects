<?php

/**
 * @package     valueobjects
 * @since       11.03.2024 - 14:14
 * @author      Patrick Froch <info@easySolutionsIT.de>
 * @see         http://easySolutionsIT.de
 * @copyright   e@sy Solutions IT 2024
 * @license     LGPL
 */

declare(strict_types=1);

namespace Esit\Valueobjects\Tests\Duration\Valueobjects;

use Esit\Valueobjects\Classes\Duration\Services\Calculators\DurationCalculator;
use Esit\Valueobjects\Classes\Duration\Services\Converter\DurationConverter;
use Esit\Valueobjects\Classes\Duration\Services\Factories\DurationFactory;
use Esit\Valueobjects\Classes\Duration\Services\Helper\DurationDivider;
use Esit\Valueobjects\Classes\Duration\Valueobjects\DurationValue;
use Esit\Valueobjects\Classes\Duration\Valueobjects\HourValue;
use Esit\Valueobjects\Classes\Duration\Valueobjects\MinuteValue;
use Esit\Valueobjects\Classes\Duration\Valueobjects\SecondValue;
use PHPUnit\Framework\MockObject\MockObject;
use PHPUnit\Framework\TestCase;

class DurationValueTest extends TestCase
{


    /**
     * @var int
     */
    private int $time = 0;


    /**
     * @var DurationCalculator|(DurationCalculator&MockObject)|MockObject
     */
    private DurationCalculator $calculator;


    /**
     * @var DurationConverter|(DurationConverter&MockObject)|MockObject
     */
    private DurationConverter $converter;


    /**
     * @var DurationFactory|(DurationFactory&MockObject)|MockObject
     */
    private DurationFactory $factory;


    /**
     * @var DurationValue
     */
    private DurationValue $duration;


    protected function setUp(): void
    {
        $this->time         = \time();

        $this->calculator   = $this->getMockBuilder(DurationCalculator::class)
                                   ->disableOriginalConstructor()
                                   ->getMock();

        $this->converter    = $this->getMockBuilder(DurationConverter::class)
                                   ->disableOriginalConstructor()
                                   ->getMock();

        $this->factory      = $this->getMockBuilder(DurationFactory::class)
                                   ->disableOriginalConstructor()
                                   ->getMock();

        $this->calculator->method('getAbsoluteTime')
                         ->willReturn(\abs($this->time));

        $this->duration = new DurationValue($this->time, $this->factory, $this->calculator, $this->converter);
    }


    public function testValue(): void
    {
        $this->assertSame($this->time, $this->duration->value());
    }


    public function testToString(): void
    {
        $expected = '01:02:03';

        $this->converter->expects(self::once())
                        ->method('convertToFormatedString')
                        ->with($this->duration, 'H:i:s', '-')
                        ->willReturn($expected);

        $this->assertSame($expected, $this->duration->__toString());
    }


    public function testIsNegativReturnFalseIfTimeIsNegativ(): void
    {
        $this->assertFalse($this->duration->isNegativ());
    }


    public function testIsNegativReturnTrueIfTimeIsPositiv(): void
    {
        $time       = \time() * -1;
        $duration   = new DurationValue($time, $this->factory, $this->calculator, $this->converter);
        $this->assertTrue($duration->isNegativ());
    }


    public function testGetFormatedUseDefaultParameter(): void
    {
        $expected = '01:02:03';

        $this->converter->expects(self::once())
                        ->method('convertToFormatedString')
                        ->with($this->duration, 'H:i:s', '-')
                        ->willReturn($expected);

        $this->assertSame($expected, $this->duration->parse());
    }


    public function testGetFormatedUseIndividualParameter(): void
    {
        $expected   = '01-02_03';
        $format     = 'H-i_s';
        $prefix     = '#';

        $this->converter->expects(self::once())
                        ->method('convertToFormatedString')
                        ->with($this->duration, $format, $prefix)
                        ->willReturn($expected);

        $this->assertSame($expected, $this->duration->parse($format, $prefix));
    }


    public function testGetHours(): void
    {
        $expected = $this->getMockBuilder(HourValue::class)
                         ->disableOriginalConstructor()
                         ->getMock();

        $this->factory->expects(self::once())
                      ->method('createHourFromInt')
                      ->with($this->time)
                      ->willReturn($expected);

        $this->assertSame($expected, $this->duration->getHoursValue());
    }


    public function testGetMinutes(): void
    {
        $expected = $this->getMockBuilder(MinuteValue::class)
                         ->disableOriginalConstructor()
                         ->getMock();

        $this->factory->expects(self::once())
                      ->method('createMinuteFromInt')
                      ->with($this->time)
                      ->willReturn($expected);

        $this->assertSame($expected, $this->duration->getMinutesValue());
    }


    public function testGetSeconds(): void
    {
        $expected = $this->getMockBuilder(SecondValue::class)
                         ->disableOriginalConstructor()
                         ->getMock();

        $this->factory->expects(self::once())
                      ->method('createSecondFromInt')
                      ->with($this->time)
                      ->willReturn($expected);

        $this->assertSame($expected, $this->duration->getSecondsValue());
    }


    public function testAdd(): void
    {
        $expected = 12;

        $this->calculator->expects(self::once())
                         ->method('add')
                         ->with($this->time, $this->time)
                         ->willReturn($expected);

        $this->factory->expects(self::once())
                      ->method('createDurationFromInt')
                      ->with($expected)
                      ->willReturn($this->duration);

        $this->assertSame($this->duration, $this->duration->add($this->duration));
    }


    public function testSubtract(): void
    {
        $expected = 12;

        $this->calculator->expects(self::once())
                         ->method('subtract')
                         ->with($this->time, $this->time)
                         ->willReturn($expected);

        $this->factory->expects(self::once())
                      ->method('createDurationFromInt')
                      ->with($expected)
                      ->willReturn($this->duration);

        $this->assertSame($this->duration, $this->duration->subtract($this->duration));
    }


    public function testMultiply(): void
    {
        $operand    = 12;
        $expected   = $this->time + $operand;

        $this->calculator->expects(self::once())
                         ->method('multiply')
                         ->with($this->time, $operand)
                         ->willReturn($expected);

        $this->factory->expects(self::once())
                      ->method('createDurationFromInt')
                      ->with($expected)
                      ->willReturn($this->duration);

        $this->assertSame($this->duration, $this->duration->multiply($operand));
    }


    public function testDivide(): void
    {
        $operand    = 12;
        $expected   = $this->time + $operand;

        $this->calculator->expects(self::once())
                         ->method('divide')
                         ->with($this->time, $operand)
                         ->willReturn($expected);

        $this->factory->expects(self::once())
                      ->method('createDurationFromInt')
                      ->with($expected)
                      ->willReturn($this->duration);

        $this->assertSame($this->duration, $this->duration->divide($operand));
    }
}
