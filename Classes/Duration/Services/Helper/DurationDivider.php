<?php

/**
 * @since       11.03.2024 - 13:15
 *
 * @author      Patrick Froch <info@easySolutionsIT.de>
 *
 * @see         http://easySolutionsIT.de
 *
 * @copyright   e@sy Solutions IT 2024
 * @license     LGPL
 */

declare(strict_types=1);

namespace Esit\Valueobjects\Classes\Duration\Services\Helper;

use Esit\Valueobjects\Classes\Duration\Services\Calculators\DurationCalculator;

class DurationDivider
{


    /**
     * Anzahl der Sekunden pro Stunde.
     */
    public const SEC_PER_HOUR = 3600;


    /**
     * Anzahl der Sekunden pro Minute.
     */
    public const SEC_PER_MINUTE = 60;


    /**
     * @param DurationCalculator $calculator
     */
    public function __construct(private readonly DurationCalculator $calculator)
    {
    }


    /**
     * Gibt die Sekunden der ganzen Stunden zurück.
     *
     * @param int $time
     *
     * @return int
     */
    public function getScondsOfHours(int $time): int
    {
        $rest = $this->calculator->modulo($time, self::SEC_PER_HOUR);

        return $this->calculator->subtract($time, $rest);
    }


    /**
     * Gibt die Anzahl der Stunden als absoluten Wert zurück.
     *
     * @param int $time
     *
     * @return int
     */
    public function getHoursCount(int $time): int
    {
        $time   = $this->getScondsOfHours($time);
        $hours  = (int) $this->calculator->divide($time, self::SEC_PER_HOUR);

        return $this->calculator->getAbsoluteTime($hours);
    }


    /**
     * Gibt die Sekunden der ganzen Minuten ohne Stunden zurück.
     *
     * @param int $time
     *
     * @return int
     */
    public function getScondsOfMinutes(int $time): int
    {
        $scondsOfHours  = $this->getScondsOfHours($time);
        $minutes        = $this->calculator->subtract($time, $scondsOfHours);
        $rest           = $this->calculator->modulo($minutes, self::SEC_PER_MINUTE);

        return $this->calculator->subtract($minutes, $rest);
    }


    /**
     * Gibt die Sekunden der ganzen Minuten ohne Stunden zurück.
     *
     * @param int $time
     *
     * @return int
     */
    public function getMinutesCount(int $time): int
    {
        $time       = $this->getScondsOfMinutes($time);
        $minutes    = (int) $this->calculator->divide($time, self::SEC_PER_MINUTE);

        return $this->calculator->getAbsoluteTime($minutes);
    }


    /**
     * Gibt die restlichen Sekunden ohne Stunden und Minuten zurück.
     *
     * @param int $time
     *
     * @return int
     */
    public function getSconds(int $time): int
    {
        return $this->calculator->modulo($time, self::SEC_PER_MINUTE);
    }
}
