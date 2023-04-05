<?php

/**
 * @package   valueobjects
 * @since     09.08.2022 - 09:38
 * @author    Patrick Froch <info@easySolutionsIT.de>
 * @see       http://easySolutionsIT.de
 * @copyright e@sy Solutions IT 2022
 * @license   LGPL
 */

declare(strict_types=1);

namespace Esit\Valueobjects\Classes\Ip\Services\Validators;

class IpValidator
{
    /**
     * Regulärer Ausdruck für die IP-Adresse.
     * @see https://rgxdb.com/r/1C0GISTC
     */
    private const RGXP_IP = '/^(?:25[0-5]|2[0-4]\d|1\d\d|[1-9]\d|\d)(?:\.(?:25[0-5]|2[0-4]\d|1\d\d|[1-9]\d|\d)){3}$/';


    /**
     * @param  string $value
     * @return bool
     */
    public function isValid(string $value): bool
    {
        return 1 === \preg_match(self::RGXP_IP, $value);
    }
}
