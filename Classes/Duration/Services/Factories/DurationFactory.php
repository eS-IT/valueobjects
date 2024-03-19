<?php

/**
 * @since       11.03.2024 - 11:10
 *
 * @author      Patrick Froch <info@easySolutionsIT.de>
 *
 * @see         http://easySolutionsIT.de
 *
 * @copyright   e@sy Solutions IT 2024
 * @license     LGPL
 */

declare(strict_types=1);

namespace Esit\Valueobjects\Classes\Duration\Services\Factories;

use Esit\Valueobjects\Classes\Duration\Services\Calculators\DurationCalculator;
use Esit\Valueobjects\Classes\Duration\Services\Parser\DurationParser;
use Esit\Valueobjects\Classes\Duration\Valueobjects\DurationValue;

class DurationFactory
{


    /**
     * @param DurationCalculator $calculator
     * @param DurationParser     $parser
     */
    public function __construct(
        private readonly DurationCalculator $calculator,
        private readonly DurationParser $parser
    ) {
    }


    /**
     * Gibt ein Duration-Objekt zurück.
     *
     * @param int    $time
     * @param string $format
     * @param string $prefix
     *
     * @return DurationValue
     */
    public function createDurationFromInt(int $time, string $format = 'H:i:s', string $prefix = '-'): DurationValue
    {
        return new DurationValue($time, $format, $prefix, $this, $this->calculator, $this->parser);
    }
}
