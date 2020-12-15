<?php

declare(strict_types=1);

namespace App\Helpers;

/**
 * Class Matrix
 * @package App\Helpers
 */
class Matrix
{

    /**
     * data of matrix
     *
     * @var
     */
    public $data = [];

    /**
     * Matrix constructor.
     *
     * @param $matrix
     */
    public function __construct($matrix)
    {
        $this->data = $matrix;
    }

    /**
     * returns the matrix row count
     *
     * @return int
     */
    public function getRows(): int
    {
        return count($this->data);
    }

    /**
     * returns the matrix column count
     *
     * @return int
     */
    public function getColumns(): int
    {
        return count($this->data[0]);
    }

    /**
     * multiply two matrices
     *
     * @param Matrix $matrix2
     *
     * @return Matrix
     */
    public function multiply(Matrix $matrix2): Matrix
    {
        $matrix1 = $this;

        $matrix1Rows = $matrix1->getRows();
        $matrix2Columns = $matrix2->getColumns();
        $matrix2Rows = $matrix2->getRows();


        $result = new Matrix([]);
        for ($i = 0; $i < $matrix1Rows; $i++) {
            for ($j = 0; $j < $matrix2Columns; $j++) {
                $result->data[$i][$j] = 0;
                for ($k = 0; $k < $matrix2Rows; $k++)
                    $result->data[$i][$j] += $matrix1->data[$i][$k] * $matrix2->data[$k][$j];
            }
        }

        return $result;
    }


    /**
     * check if two matrices are multiplicable
     *
     * @param Matrix $matrix1
     * @param Matrix $matrix2
     *
     * @return bool
     */
    public static function multiplicable(Matrix $matrix1, Matrix $matrix2): bool
    {
        return $matrix1->getColumns() == $matrix2->getRows();
    }
}
