<?php

/**
 * @package   valueobjects
 * @since     09.08.2022 - 10:40
 * @author    Patrick Froch <info@easySolutionsIT.de>
 * @see       http://easySolutionsIT.de
 * @copyright e@sy Solutions IT 2022
 * @license   LGPL
 */

declare(strict_types=1);

namespace Esit\Valueobjects\Classes\Ip\Valueobjects;

use Esit\Valueobjects\Classes\Ip\Exceptions\NotAValidIpException;
use Esit\Valueobjects\Classes\Ip\Services\Validators\IpValidator;

class IpValue
{
    /**
     * @var string
     */
    private string $value;


    /**
     * @param string $value
     */
    protected function __construct(string $value)
    {
        $this->value = $value;
    }


    /**
     * @param  string      $value
     * @param  IpValidator $validator
     * @return static
     */
    public static function fromString(string $value, IpValidator $validator): self
    {
        if (!$validator->isValid($value)) {
            throw new NotAValidIpException('string is not a valid ip address');
        }

        return new self($value);
    }


    /**
     * @return string
     */
    public function value(): string
    {
        return $this->value;
    }


    /**
     * @return string
     */
    public function __toString(): string
    {
        return $this->value();
    }
}
