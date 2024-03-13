<?php

/**
 * @package     valueobjects
 * @since       11.03.2024 - 15:03
 * @author      Patrick Froch <info@easySolutionsIT.de>
 * @see         http://easySolutionsIT.de
 * @copyright   e@sy Solutions IT 2024
 * @license     LGPL
 */

declare(strict_types=1);

namespace Esit\Valueobjects\Tests\Duration\Services\Factories;

use Esit\Valueobjects\Classes\Duration\Services\Calculators\DurationCalculator;
use Esit\Valueobjects\Classes\Duration\Services\Converter\DurationConverter;
use Esit\Valueobjects\Classes\Duration\Services\Factories\DurationFactory;
use Esit\Valueobjects\Classes\Duration\Services\Helper\DurationDivider;
use \PHPUnit\Framework\MockObject\MockObject;
use PHPUnit\Framework\TestCase;

class DurationFactoryTest extends TestCase
{


    /**
     * @var (DurationCalculator&MockObject)|MockObject
     */
    private $calculator;


    /**
     * @var (DurationConverter&MockObject)|MockObject
     */
    private $converter;


    /**
     * @var (DurationDivider&MockObject)|MockObject
     */
    private $divider;


    /**
     * @var DurationFactory
     */
    private $factory;


    /**
     * @var int
     */
    private $time = 0;


    protected function setUp(): void
    {
        $this->calculator   = $this->getMockBuilder(DurationCalculator::class)
                                   ->disableOriginalConstructor()
                                   ->getMock();

        $this->converter    = $this->getMockBuilder(DurationConverter::class)
                                   ->disableOriginalConstructor()
                                   ->getMock();

        $this->divider      = $this->getMockBuilder(DurationDivider::class)
                                   ->disableOriginalConstructor()
                                   ->getMock();

        $this->time         = \time();

        $this->factory      = new DurationFactory($this->calculator, $this->converter, $this->divider);
    }


    public function testCreateDuration(): void
    {
        $this->assertNotNull($this->factory->createDurationFromInt($this->time));
    }


    public function testCreateHourFromInt(): void
    {
        $this->assertNotNull($this->factory->createHourFromInt($this->time));
    }


    public function testCreateMinuteFromInt(): void
    {
        $this->assertNotNull($this->factory->createMinuteFromInt($this->time));
    }


    public function testCreateSecondFromInt(): void
    {
        $this->assertNotNull($this->factory->createSecondFromInt($this->time));
    }
}
