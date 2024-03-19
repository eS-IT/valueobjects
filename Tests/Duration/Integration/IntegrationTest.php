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
use Esit\Valueobjects\Classes\Duration\Services\Helper\DurationConverterHelper;
use Esit\Valueobjects\Classes\Duration\Services\Helper\DurationParserHelper;
use Esit\Valueobjects\Classes\Duration\Services\Parser\DurationParser;
use Esit\Valueobjects\Classes\Duration\Services\Factories\DurationFactory;
use Esit\Valueobjects\Classes\Duration\Services\Converter\DurationConverter;
use PHPUnit\Framework\TestCase;

class IntegrationTest extends TestCase
{


    /**
     * @var string
     */
    private string $format = 'H:i:s';


    /**
     * @var DurationFactory
     */
   private DurationFactory $factory;


    protected function setUp(): void
    {
        $calculator         = new DurationCalculator();
        $converter          = new DurationConverter($calculator);
        $converterHelper    = new DurationConverterHelper($calculator, $converter);
        $parserHelper       = new DurationParserHelper($converterHelper);
        $parser             = new DurationParser($parserHelper);
        $this->factory      = new DurationFactory($calculator, $parser);
    }


    public function testGetFormated(): void
    {
        $time   = 45296; // 12 Stunden, 34 Minuten, 56 Sekunden
        $value  = $this->factory->createDurationFromInt($time);

        $this->assertSame("12:34:56", $value->parse($this->format));
    }


    public function testGetFormatedWithNegativValue(): void
    {
        $time   = 45296 * -1; // 12 Stunden, 34 Minuten, 56 Sekunden
        $value  = $this->factory->createDurationFromInt($time);

        $this->assertSame("-12:34:56", $value->parse($this->format));
    }


    public function testGetFormatedWithIndividualPrefix(): void
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

        $this->assertSame("25:09:52", $value->parse($this->format));
    }


    public function testSubtract(): void
    {
        $time       = 45296; // 12 Stunden, 34 Minuten, 56 Sekunden
        $valueOne   = $this->factory->createDurationFromInt($time);
        $valueTwo   = $this->factory->createDurationFromInt($time);
        $value      = $valueOne->subtract($valueTwo);

        $this->assertSame("00:00:00", $value->parse($this->format));
    }


    public function testMultiply(): void
    {
        $time       = 45296; // 12 Stunden, 34 Minuten, 56 Sekunden
        $valueOne   = $this->factory->createDurationFromInt($time);
        $operand    = 2;
        $value      = $valueOne->multiply($operand);

        $this->assertSame("25:09:52", $value->parse($this->format));
    }


    public function testDivide(): void
    {
        $time       = 45296; // 12 Stunden, 34 Minuten, 56 Sekunden
        $valueOne   = $this->factory->createDurationFromInt($time);
        $operand    = 2;
        $value      = $valueOne->divide($operand);

        $this->assertSame("06:17:28", $value->parse($this->format));
    }


    public function testDotOpposite(): void
    {
        $time       = 45296; // 12 Stunden, 34 Minuten, 56 Sekunden
        $valueOne   = $this->factory->createDurationFromInt($time);
        $operand    = 2;
        $value      = $valueOne->multiply($operand);
        $value      = $value->divide($operand);

        $this->assertSame($valueOne->parse($this->format), $value->parse($this->format));
    }


    public function testDashOpposite(): void
    {
        $time       = 45296; // 12 Stunden, 34 Minuten, 56 Sekunden
        $valueOne   = $this->factory->createDurationFromInt($time);
        $valueTwo   = $this->factory->createDurationFromInt($time);
        $value      = $valueOne->add($valueTwo);
        $value      = $value->subtract($valueTwo);

        $this->assertSame($valueOne->parse($this->format), $value->parse($this->format));
    }
}
