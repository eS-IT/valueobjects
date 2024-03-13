<?php

/**
 * @since     09.08.2022 - 10:37
 *
 * @author    Patrick Froch <info@easySolutionsIT.de>
 *
 * @see       http://easySolutionsIT.de
 *
 * @copyright e@sy Solutions IT 2022
 * @license   LGPL
 */

declare(strict_types=1);

namespace Esit\Valueobjects\Classes\Ip\Services\Factories;

use Esit\Valueobjects\Classes\Ip\Services\Validators\IpValidator;
use Esit\Valueobjects\Classes\Ip\Valueobjects\IpValue;

class IpFactory
{
    /**
     * @var IpValidator
     */
    private IpValidator $validator;


    /**
     * @param IpValidator $validator
     */
    public function __construct(IpValidator $validator)
    {
        $this->validator = $validator;
    }


    /**
     * @param string $value
     *
     * @return IpValue
     */
    public function createFromString(string $value): IpValue
    {
        return IpValue::fromString($value, $this->validator);
    }
}
