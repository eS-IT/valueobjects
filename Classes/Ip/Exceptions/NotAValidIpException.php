<?php

/**
 * @since     09.08.2022 - 10:52
 *
 * @author    Patrick Froch <info@easySolutionsIT.de>
 *
 * @see       http://easySolutionsIT.de
 *
 * @copyright e@sy Solutions IT 2022
 * @license   LGPL
 */

declare(strict_types=1);

namespace Esit\Valueobjects\Classes\Ip\Exceptions;

use Esit\Valueobjects\Classes\Core\Exceptions\ExceptionInterface;

class NotAValidIpException extends \InvalidArgumentException implements ExceptionInterface
{
}
