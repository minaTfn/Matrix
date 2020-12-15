<?php

declare(strict_types=1);

namespace App\Helpers;

/**
 * Interface DisplayMatrixStrategy
 * @package App\Helpers
 */
interface DisplayMatrixStrategy
{

    public function display(Matrix $matrix): array;
}
