<?php

/**
 * @package   valueobjects
 * @since     06.08.2022 - 10:21
 * @author    Patrick Froch <info@easySolutionsIT.de>
 * @see       http://easySolutionsIT.de
 * @copyright e@sy Solutions IT 2022
 * @license   LGPL
 */

declare(strict_types=1);

namespace Esit\Valueobjects\Classes\Isbn\Services\Factories;

use Esit\Valueobjects\Classes\Isbn\Services\Validators\IsbnValidator;
use Esit\Valueobjects\Classes\Isbn\Valueobjects\Isbn10Value;
use Esit\Valueobjects\Classes\Isbn\Valueobjects\Isbn13Value;

class IsbnFactory
{
    /**
     * @var IsbnValidator
     */
    private IsbnValidator $validator;


    /**
     * @param IsbnValidator $validator
     */
    public function __construct(IsbnValidator $validator)
    {
        $this->validator = $validator;
    }


    /**
     * Erzeugt aus einem String ein Isbn13-ValueObject.
     *
     * @param  string $value
     * @return Isbn13Value
     */
    public function createIsbn13FromString(string $value): Isbn13Value
    {
        return Isbn13Value::fromString($value, $this->validator);
    }


    /**
     * Erzeugt aus einem String ein Isbn13-ValueObject.
     *
     * @param  string $value
     * @return Isbn10Value
     */
    public function createIsbn10FromString(string $value): Isbn10Value
    {
        return Isbn10Value::fromString($value, $this->validator);
    }
}
