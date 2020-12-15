<?php

declare(strict_types=1);

namespace App\Helpers;


/**
 * Display a matrix in requested format
 *
 * Class MatrixDisplay
 * @package App\Helpers
 */
class MatrixDisplay
{

    /**
     * @var DisplayMatrixStrategy
     */
    private $displayMatrix;

    public function __construct(DisplayMatrixStrategy $displayMatrix)
    {
        $this->displayMatrix = $displayMatrix;
    }


    /**
     * display matrix in requested format using strategy design pattern
     *
     * @param Matrix $matrix
     *
     * @return array
     */
    public function display(Matrix $matrix): array
    {
        return $this->displayMatrix->display($matrix);
    }

}
