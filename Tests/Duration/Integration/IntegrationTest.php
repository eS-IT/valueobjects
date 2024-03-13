<?php

/**
 * @package     valueobjects
 * @since       12.03.2024 - 15:46
 * @author      Patrick Froch <info@easySolutionsIT.de>
 * @see         http://easySolutionsIT.de
 * @copyright   e@sy Solutions IT 2024
 * @license     EULA
 */

declare(strict_types=1);

namespace Duration\Integration;

use Esit\Valueobjects\Classes\Duration\Services\Calculators\DurationCalculator;
use Esit\Valueobjects\Classes\Duration\Services\Converter\DurationConverter;
use Esit\Valueobjects\Classes\Duration\Services\Factories\DurationFactory;
use Esit\Valueobjects\Classes\Duration\Services\Helper\DurationDivider;
use PHPUnit\Framework\TestCase;

class IntegrationTest extends TestCase
{

    private DurationFactory $factory;


    protected function setUp(): void
    {
        $calculator     = new DurationCalculator();
        $converter      = new DurationConverter();
        $divider        = new DurationDivider($calculator);
        $this->factory  = new DurationFactory($calculator, $converter, $divider);
    }


    public function testGetFormated(): void
    {
        $time   = 45296; // 12 Stunden, 34 Minuten, 56 Sekunden
        $value  = $this->factory->createDurationFromInt($time);

        $this->assertSame("12:34:56", $value->parse());
    }


    public function testGetFormatedWithNegativValue(): void
    {
        $time   = 45296 * -1; // 12 Stunden, 34 Minuten, 56 Sekunden
        $value  = $this->factory->createDurationFromInt($time);

        $this->assertSame("-12:34:56", $value->parse());
    }


    public function testGetFormatedWithIndividualForma(): void
    {
        $time   = 45296 * -1; // 12 Stunden, 34 Minuten, 56 Sekunden
        $value  = $this->factory->createDurationFromInt($time);

        $this->assertSame("=>56:12:34", $value->parse('s:H:i', '=>'));
    }


    public function testAdd(): void
    {
        $time       = 45296; // 12 Stunden, 34 Minuten, 56 Sekunden
        $valueOne   = $this->factory->createDurationFromInt($time);
        $valueTwo   = $this->factory->createDurationFromInt($time);
        $value      = $valueOne->add($valueTwo);

        $this->assertSame("25:09:52", $value->parse());
    }


    public function testSubtract(): void
    {
        $time       = 45296; // 12 Stunden, 34 Minuten, 56 Sekunden
        $valueOne   = $this->factory->createDurationFromInt($time);
        $valueTwo   = $this->factory->createDurationFromInt($time);
        $value      = $valueOne->subtract($valueTwo);

        $this->assertSame("00:00:00", $value->parse());
    }


    public function testMultiply(): void
    {
        $time       = 45296; // 12 Stunden, 34 Minuten, 56 Sekunden
        $valueOne   = $this->factory->createDurationFromInt($time);
        $operand    = 2;
        $value      = $valueOne->multiply($operand);

        $this->assertSame("25:09:52", $value->parse());
    }


    public function testDivide(): void
    {
        $time       = 45296; // 12 Stunden, 34 Minuten, 56 Sekunden
        $valueOne   = $this->factory->createDurationFromInt($time);
        $operand    = 2;
        $value      = $valueOne->divide($operand);

        $this->assertSame("06:17:28", $value->parse());
    }


    public function testDotOpposite(): void
    {
        $time       = 45296; // 12 Stunden, 34 Minuten, 56 Sekunden
        $valueOne   = $this->factory->createDurationFromInt($time);
        $operand    = 2;
        $value      = $valueOne->multiply($operand);
        $value      = $value->divide($operand);

        $this->assertSame($valueOne->parse(), $value->parse());
    }


    public function testDashOpposite(): void
    {
        $time       = 45296; // 12 Stunden, 34 Minuten, 56 Sekunden
        $valueOne   = $this->factory->createDurationFromInt($time);
        $valueTwo   = $this->factory->createDurationFromInt($time);
        $value      = $valueOne->add($valueTwo);
        $value      = $value->subtract($valueTwo);

        $this->assertSame($valueOne->parse(), $value->parse());
    }


    public function testHour(): void
    {
        $time   = 45296; // 12 Stunden, 34 Minuten, 56 Sekunden
        $value  = $this->factory->createDurationFromInt($time);
        $hours  = $value->getHoursValue();

        $this->assertSame(12, $hours->count());
        $this->assertSame(12 * 3600, $hours->value());
        $this->assertSame("12", $hours->parse());
    }


    public function testMinutes(): void
    {
        $time       = 45296; // 12 Stunden, 34 Minuten, 56 Sekunden
        $value      = $this->factory->createDurationFromInt($time);
        $minutes    = $value->getMinutesValue();

        $this->assertSame(34, $minutes->count());
        $this->assertSame(34 * 60, $minutes->value());
        $this->assertSame("34", $minutes->parse());
    }


    public function testSconds(): void
    {
        $time       = 45296; // 12 Stunden, 34 Minuten, 56 Sekunden
        $value      = $this->factory->createDurationFromInt($time);
        $seconds    = $value->getSecondsValue();

        $this->assertSame(56, $seconds->value());
        $this->assertSame("56", $seconds->parse());
    }
}
