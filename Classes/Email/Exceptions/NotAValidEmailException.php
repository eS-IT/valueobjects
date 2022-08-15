<?php

/**
 * @package   valueobjects
 * @since     08.08.2022 - 15:52
 * @author    Patrick Froch <info@easySolutionsIT.de>
 * @see       http://easySolutionsIT.de
 * @copyright e@sy Solutions IT 2022
 * @license   LGPL
 */

declare(strict_types=1);

namespace Esit\Valueobjects\Classes\Email\Exceptions;

use Esit\Valueobjects\Classes\Core\Exceptions\ExceptionInterface;

class NotAValidEmailException extends \InvalidArgumentException implements ExceptionInterface
{
}
