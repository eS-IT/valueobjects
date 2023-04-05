<?php

/**
 * @package   valueobjects
 * @since     08.08.2022 - 15:41
 * @author    Patrick Froch <info@easySolutionsIT.de>
 * @see       http://easySolutionsIT.de
 * @copyright e@sy Solutions IT 2022
 * @license   LGPL
 */

declare(strict_types=1);

namespace Esit\Valueobjects\Classes\Email\Services\Validators;

class EmailValidator
{
    /**
     * Regulärer Ausdruck für die E-Mail-Adresse.
     * @see https://rgxdb.com/r/1JWKZ0PW
     */
    private const RGXP_EMAIL = '/^[-!#-\'*+\\/-9=?^-~]+(?:\\.[-!#-\'*+\\/-9=?^-~]+)*@[-!#-\'*+\\/-9=?^-~]+(?:\\.' .
                               '[-!#-\'*+\\/-9=?^-~]+)+$/i';


    /**
     * Prüft, ob der übergebene String eine valide E-Mail-Adresse ist.
     * @param  string $value
     * @return bool
     */
    public function isValid(string $value): bool
    {
        return 1 === \preg_match(self::RGXP_EMAIL, $value);
    }
}
