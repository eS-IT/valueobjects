<?php

/**
 * @package   valueobjects
 * @since     15.05.2022 - 09:43
 * @author    Patrick Froch <info@easySolutionsIT.de>
 * @see       http://easySolutionsIT.de
 * @copyright e@sy Solutions IT 2022
 * @license   LGPL
 */

declare(strict_types=1);

namespace Esit\Valueobjects\Classes\Money\Exceptions;

use Esit\Valueobjects\Classes\Core\Exceptions\ExceptionInterface;

class NotSameDecimalPlacesException extends \InvalidArgumentException implements ExceptionInterface
{
}
