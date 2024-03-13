<?php

/**
 * @package     valueobjects
 * @since       12.03.2024 - 14:06
 * @author      Patrick Froch <info@easySolutionsIT.de>
 * @see         http://easySolutionsIT.de
 * @copyright   e@sy Solutions IT 2024
 * @license     LGPL
 */

declare(strict_types=1);

namespace Esit\Valueobjects\Tests\Duration\Services\Helper;

use Esit\Valueobjects\Classes\Duration\Services\Calculators\DurationCalculator;
use Esit\Valueobjects\Classes\Duration\Services\Helper\DurationDivider;
use Esit\Valueobjects\EsitTestCase;
use PHPUnit\Framework\MockObject\MockObject;

class DurationDividerTest extends EsitTestCase
{


    /**
     * @var (DurationCalculator&MockObject)|MockObject
     */
    private $calculator;


    /**
     * @var int
     */
    private int $time;


    /**
     * @var DurationDivider
     */
    private DurationDivider $divider;


    protected function setUp(): void
    {
        $this->calculator   = $this->getMockBuilder(DurationCalculator::class)
                                   ->disableOriginalConstructor()
                                   ->getMock();

        $this->time         = \time();
        $this->divider      = new DurationDivider($this->calculator);
    }


    public function testGetScondsOfHours(): void
    {
        $expected   = 12;
        $rest       = 34;

        $this->calculator->expects(self::once())
                         ->method('modulo')
                         ->with($this->time, $this->divider::SEC_PER_HOUR)
                         ->willReturn($rest);

        $this->calculator->expects(self::once())
                         ->method('subtract')
                         ->with($this->time, $rest)
                         ->willReturn($expected);

        $this->assertSame($expected, $this->divider->getScondsOfHours($this->time));
    }


    public function testGetHoursCount(): void
    {
        $time       = 12;
        $rest       = 34;
        $hours      = 56;
        $expected   = 78;

        $this->calculator->expects(self::once())
                         ->method('modulo')
                         ->with($this->time, $this->divider::SEC_PER_HOUR)
                         ->willReturn($rest);

        $this->calculator->expects(self::once())
                         ->method('subtract')
                         ->with($this->time, $rest)
                         ->willReturn($time);

        $this->calculator->expects(self::once())
                         ->method('divide')
                         ->with($time, $this->divider::SEC_PER_HOUR)
                         ->willReturn($hours);

        $this->calculator->expects(self::once())
                         ->method('getAbsoluteTime')
                         ->with($hours)
                         ->willReturn($expected);

        $this->assertSame($expected, $this->divider->getHoursCount($this->time));
    }


    public function testGetScondsOfMinutes(): void
    {
        $rest           = 12;
        $scondsOfHours  = 34;
        $minutes        = 56;
        $expected       = 78;

        $this->addConsecutiveReturn(
            $this->calculator,
            'modulo',
            [$rest, $rest],
            [
                [$this->time, $this->divider::SEC_PER_HOUR],
                [$minutes, $this->divider::SEC_PER_MINUTE]
            ]
        );

        $this->addConsecutiveReturn(
            $this->calculator,
            'subtract',
            [$scondsOfHours, $minutes, $expected],
            [
                [$this->time, $rest],
                [$this->time, $scondsOfHours],
                [$minutes, $rest]
            ]
        );

        $this->assertSame($expected, $this->divider->getScondsOfMinutes($this->time));
    }


    public function testGetMinutesCount(): void
    {
        $rest           = 12;
        $scondsOfHours  = 34;
        $minutes        = 56;
        $expected       = 78;
        $dividedMinutes = 9.876;

        $this->addConsecutiveReturn(
            $this->calculator,
            'modulo',
            [$rest, $rest],
            [
                [$this->time, $this->divider::SEC_PER_HOUR],
                [$minutes, $this->divider::SEC_PER_MINUTE]
            ]
        );

        $this->addConsecutiveReturn(
            $this->calculator,
            'subtract',
            [$scondsOfHours, $minutes, $this->time],
            [
                [$this->time, $rest],
                [$this->time, $scondsOfHours],
                [$minutes, $rest]
            ]
        );

        $this->calculator->expects(self::once())
                         ->method('divide')
                         ->with($this->time, $this->divider::SEC_PER_MINUTE)
                         ->willReturn($dividedMinutes);

        $this->calculator->expects(self::once())
                         ->method('getAbsoluteTime')
                         ->with((int) $dividedMinutes)
                         ->willReturn($expected);

        $this->assertSame($expected, $this->divider->getMinutesCount($this->time));
    }


    public function testGetSconds(): void
    {
        $expected = 12;

        $this->calculator->expects(self::once())
                         ->method('modulo')
                         ->with($this->time, $this->divider::SEC_PER_MINUTE)
                         ->willReturn($expected);

        $this->assertSame($expected, $this->divider->getSconds($this->time));
    }
}
