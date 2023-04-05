<?php

/**
 * @package   valueobjects
 * @since     08.08.2022 - 10:53
 * @author    Patrick Froch <info@easySolutionsIT.de>
 * @see       http://easySolutionsIT.de
 * @copyright e@sy Solutions IT 2022
 * @license   LGPL
 */

declare(strict_types=1);

namespace Esit\Valueobjects\Classes\Url\Services\Validators;

class UrlValidator
{
    /**
     * Regulärer Ausdruck für die Url.
     * Orginal:
     * @see    https://gist.github.com/dperini/729294
     * @author Diego Perini (http://www.iport.it)
     */
    private const RGXP_URL = '/^(?:(?:(?:<schemas>):)?\/\/)(?:\S+(?::\S*)?@)?(?:(?!(?:10|127)' .
                             '(?:\.\d{1,3}){3})(?!(?:169\.254|192\.168)(?:\.\d{1,3}){2})(?!172\.(?:1[6-9]|2\d|3' .
                             '[0-1])(?:\.\d{1,3}){2})(?:[1-9]\d?|1\d\d|2[01]\d|22[0-3])(?:\.(?:1?\d{1,2}|2[0-4]' .
                             '\d|25[0-5])){2}(?:\.(?:[1-9]\d?|1\d\d|2[0-4]\d|25[0-4]))|(?:(?:[a-z0-9][a-z0-9_-]' .
                             '{0,62})?[a-z0-9]\.)+(?:[a-z]{2,}\.?))(?::\d{2,5})?(?:[\/?#]\S*)?$/';


    /**
     * Erlaubte Schemata für die Url.
     * @var string
     */
    private string $schemas = 'https?|ftp|ssh|sftp|smb';


    /**
     * Prüft, ob der übergebene String eine valide Url ist.
     * @param string $value
     * @param bool   $forceSchema
     * @param string $schema
     * @return bool
     */
    public function isValid(string $value, bool $forceSchema = false, string $schema = ''): bool
    {
        $schema     = $schema ?: $this->schemas;
        $rgxp       = \str_replace('<schemas>', $schema, self::RGXP_URL);

        if (false === $forceSchema) {
            $rgxp = \str_replace('):)?\/\/)', '):)?\/\/){0,1}', $rgxp);
        }

        return 1 === \preg_match($rgxp, $value);
    }
}
