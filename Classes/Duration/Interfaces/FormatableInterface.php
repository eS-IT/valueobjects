<?php

/**
 * @since       13.03.2024 - 09:56
 *
 * @author      Patrick Froch <info@easySolutionsIT.de>
 *
 * @see         http://easySolutionsIT.de
 *
 * @copyright   e@sy Solutions IT 2024
 * @license     EULA
 */

declare(strict_types=1);

namespace Esit\Valueobjects\Classes\Duration\Interfaces;

interface FormatableInterface
{


    public function value(): int;


    public function parse(): string;
}
