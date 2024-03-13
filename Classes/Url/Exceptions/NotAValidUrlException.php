<?php

/**
 * @since     08.08.2022 - 10:42
 *
 * @author    Patrick Froch <info@easySolutionsIT.de>
 *
 * @see       http://easySolutionsIT.de
 *
 * @copyright e@sy Solutions IT 2022
 * @license   LGPL
 */

declare(strict_types=1);

namespace Esit\Valueobjects\Classes\Url\Exceptions;

use Esit\Valueobjects\Classes\Core\Exceptions\ExceptionInterface;

class NotAValidUrlException extends \InvalidArgumentException implements ExceptionInterface
{
}
