<?php

/**
 * @since     18.09.2022 - 16:17
 *
 * @author    Patrick Froch <info@easySolutionsIT.de>
 *
 * @see       http://easySolutionsIT.de
 *
 * @copyright e@sy Solutions IT 2022
 * @license   LGPL
 */

declare(strict_types=1);

namespace Esit\Valueobjects\Classes\Iban\Exceptions;

use Esit\Valueobjects\Classes\Core\Exceptions\ExceptionInterface;

class NotAValidIbanException extends \InvalidArgumentException implements ExceptionInterface
{
}
