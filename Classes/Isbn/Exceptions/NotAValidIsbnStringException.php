<?php

/**
 * @package   valueobjects
 * @since     21.07.2022 - 17:42
 * @author    Patrick Froch <info@easySolutionsIT.de>
 * @see       http://easySolutionsIT.de
 * @copyright e@sy Solutions IT 2022
 * @license   LGPL
 */

declare(strict_types=1);

namespace Esit\Valueobjects\Classes\Isbn\Exceptions;

use Esit\Valueobjects\Classes\Core\Exceptions\ExceptionInterface;

class NotAValidIsbnStringException extends \InvalidArgumentException implements ExceptionInterface
{
}
