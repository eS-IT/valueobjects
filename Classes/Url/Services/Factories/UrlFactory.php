<?php

/**
 * @since     06.08.2022 - 10:21
 *
 * @author    Patrick Froch <info@easySolutionsIT.de>
 *
 * @see       http://easySolutionsIT.de
 *
 * @copyright e@sy Solutions IT 2022
 * @license   LGPL
 */

declare(strict_types=1);

namespace Esit\Valueobjects\Classes\Url\Services\Factories;

use Esit\Valueobjects\Classes\Url\Services\Validators\UrlValidator;
use Esit\Valueobjects\Classes\Url\Valueobjects\UrlValue;

class UrlFactory
{
    /**
     * @var UrlValidator
     */
    private UrlValidator $validator;


    /**
     * @param UrlValidator $validator
     */
    public function __construct(UrlValidator $validator)
    {
        $this->validator = $validator;
    }


    /**
     * Erzeugt aus einem String ein Isbn13-ValueObject.
     *
     * @param string $value
     * @param bool   $forceSchema
     * @param string $schema
     *
     * @return UrlValue
     */
    public function createFromString(string $value, bool $forceSchema = false, string $schema = ''): UrlValue
    {
        return UrlValue::fromString($value, $this->validator, $forceSchema, $schema);
    }
}
