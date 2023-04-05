<?php

/**
 * @package   valueobjects
 * @since     21.07.22 - 17:33
 * @author    Patrick Froch <info@easySolutionsIT.de>
 * @see       http://easySolutionsIT.de
 * @copyright e@sy Solutions IT 2022
 * @license   LGPL
 */

declare(strict_types=1);

namespace Esit\Valueobjects\Classes\Money\Services\Validators;

use Esit\Valueobjects\Classes\Money\Exceptions\ParameterIsEmptyException;

class MoneyValidator
{
    /**
     * Prüft, ob es sich um eine Zahl mit zwei Nachkommastellen handelt.
     * @param  string $value
     * @param  string $thousandSeparator
     * @param  string $decimal
     * @param  int    $decimalPlaces
     * @return bool
     */
    public function isValidString(
        string $value,
        string $thousandSeparator = '.',
        string $decimal = ',',
        int $decimalPlaces = 2
    ): bool {
        $decimalRgxp = '';

        if ('' === $value) {
            throw new ParameterIsEmptyException('value could not be empty');
        }

        if (0 !== $decimalPlaces && '' === $decimal) {
            throw new ParameterIsEmptyException('decimal char could not be empty if deciaml places is not 0');
        }

        if ($decimalPlaces > 0) {
            $decimalRgxp = $decimal . '\d{' . $decimalPlaces . '}';
        }

        $rgxp = '/^\d+' . $decimalRgxp . '\z';

        if ('' !== $thousandSeparator) {
            $rgxp = '/^\d{1,3}(\\' . $thousandSeparator . '\d{3})*' . $decimalRgxp . '$';
        }

        $rgxp .= '/';

        return 1 === \preg_match($rgxp, $value);
    }


    /**
     * Prüft, ob ein Integerwert ein valider Centbetrag ist.
     * @param  int $value
     * @return bool
     */
    public function isValidInt(int $value): bool
    {
        return $value >= 0;
    }
}
