<?php

/**
 * @since     21.07.2022 - 17:45
 *
 * @author    Patrick Froch <info@easySolutionsIT.de>
 *
 * @see       http://easySolutionsIT.de
 *
 * @copyright e@sy Solutions IT 2022
 * @license   LGPL
 */

declare(strict_types=1);

namespace Esit\Valueobjects\Classes\Money\Exceptions;

use Esit\Valueobjects\Classes\Core\Exceptions\ExceptionInterface;

class MoneyIsEmptyException extends \InvalidArgumentException implements ExceptionInterface
{
}
