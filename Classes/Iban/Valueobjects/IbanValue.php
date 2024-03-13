<?php

/**
 * @since     06.08.2022 - 10:12
 *
 * @author    Patrick Froch <info@easySolutionsIT.de>
 *
 * @see       http://easySolutionsIT.de
 *
 * @copyright e@sy Solutions IT 2022
 * @license   LGPL
 */

declare(strict_types=1);

namespace Esit\Valueobjects\Classes\Iban\Valueobjects;

use Esit\Valueobjects\Classes\Iban\Exceptions\NotAValidIbanException;
use Esit\Valueobjects\Classes\Iban\Services\Converter\IbanConverter;
use Esit\Valueobjects\Classes\Iban\Services\Validators\IbanValidator;

class IbanValue implements \Stringable
{
    /**
     * @var string
     */
    private string $value;


    /**
     * @var IbanConverter
     */
    private IbanConverter $converter;


    /**
     * @param string        $value
     * @param IbanConverter $converter
     */
    protected function __construct(string $value, IbanConverter $converter)
    {
        $this->value        = $value;
        $this->converter    = $converter;
    }


    /**
     * @return string
     */
    public function __toString(): string
    {
        return $this->value();
    }


    /**
     * Erzeugt aus einem String ein IbanValue-Objekt.
     *
     * @param string        $value
     * @param IbanConverter $converter
     * @param IbanValidator $validator
     *
     * @return self
     */
    public static function fromString(string $value, IbanConverter $converter, IbanValidator $validator): self
    {
        if ('' === $value) {
            throw new NotAValidIbanException('iban could not be empty');
        }

        $value = $converter->convertToIban($value);

        if (!$validator->isValid($value)) {
            throw new NotAValidIbanException('string is no valid iban');
        }

        if (!$validator->isValidChecksum($value)) {
            throw new NotAValidIbanException('checksum is not valid');
        }

        return new self($value, $converter);
    }


    /**
     * @return string
     */
    public function value(): string
    {
        return $this->value;
    }


    /**
     * Gibt einen formatierten Wert zurück.
     *
     * @return string
     */
    public function getFormatedValue(): string
    {
        return $this->converter->convertToFormated($this->value);
    }
}
