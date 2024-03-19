<?php

/**
 * @since       11.03.2024 - 11:09
 *
 * @author      Patrick Froch <info@easySolutionsIT.de>
 *
 * @see         http://easySolutionsIT.de
 *
 * @copyright   e@sy Solutions IT 2024
 * @license     LGPL
 */

declare(strict_types=1);

namespace Esit\Valueobjects\Classes\Duration\Services\Parser;

use Esit\Valueobjects\Classes\Duration\Library\DurationFormatParts;
use Esit\Valueobjects\Classes\Duration\Services\Helper\DurationParserHelper;
use Esit\Valueobjects\Classes\Duration\Valueobjects\DurationValue;

class DurationParser
{


    /**
     * @param DurationParserHelper $parser
     */
    public function __construct(private readonly DurationParserHelper $parser)
    {
    }


    /**
     * Konvertiert eine Zahl in einen String.
     *
     * @param int  $time
     * @param bool $addLeadingZero
     *
     * @return string
     */
    public function parseValue(int $time, bool $addLeadingZero): string
    {
        return $time < 10 && true === $addLeadingZero ? "0$time" : (string) $time;
    }


    /**
     * Konvertiert die Objekte in einen Zeitstring für die Ausgabe.
     *
     * @param DurationValue $time
     * @param string        $format
     * @param string        $prefix
     * @param bool          $addLeadingZero
     *
     * @return string
     */
    public function parseString(
        DurationValue $time,
        string $format,
        string $prefix = '-',
        bool $addLeadingZero = true
    ): string {
        $prefix = $time->isNegativ() ? $prefix : '';

        foreach (DurationFormatParts::cases() as $key) {
            if (\substr_count($format, $key->name)) {
                $replace    = $this->parser->parseToken($key, $time->value());
                $replace    = $this->parseValue($replace, $addLeadingZero);
                $format     = \str_replace($key->name, $replace, $format);
            }
        }

        return $prefix . $format;
    }
}
