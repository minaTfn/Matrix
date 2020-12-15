<?php

declare(strict_types=1);

namespace App\Helpers;

/**
 * Display the matrix in excel format via strategy design pattern
 *
 * Class ExcelMatrixDisplay
 * @package App\Helpers
 */
class ExcelMatrixDisplay implements DisplayMatrixStrategy
{

    private $letters = [
        0 => '0', 1 => 'A', 2 => 'B', 3 => 'C', 4 => 'D', 5 => 'E', 6 => 'F', 7 => 'G', 8 => 'H', 9 => 'I',
        10 => 'J', 11 => 'K', 12 => 'L', 13 => 'M', 14 => 'N', 15 => 'O', 16 => 'P', 17 => 'Q', 18 => 'R',
        19 => 'S', 20 => 'T', 21 => 'U', 22 => 'V', 23 => 'W', 24 => 'X', 25 => 'Y', 26 => 'Z'
    ];

    /**
     * display matrix in excel format
     *
     * @param Matrix $matrix
     *
     * @return array
     */
    public function display(Matrix $matrix): array
    {
        $col = $matrix->getColumns();
        $row = $matrix->getRows();

        $result = [];

        for ($i = 0; $i < $row; $i++) {
            for ($j = 0; $j < $col; $j++) {
                $result[$i][$j] = $this->convertToExcelFormat($matrix->data[$i][$j]);
            }
        }

        return $result;

    }

    /**
     * convert a number to equivalent excel number
     *
     * @param int $number
     *
     * @return string
     */
    public function convertToExcelFormat(int $number): string
    {
        $results = [];

        if ($number <= 0) {
            return 'NaN';
        }

        if ($number > 26) {
            do {
                $quotient = intval($number / 26);

                $mod = $number % 26;
                if ($mod == 0) {
                    $mod = 26;
                    $quotient--;
                }

                // add every remaining number
                $results[] = $this->letters[$mod];

                $number = $quotient;
            } while ($number > 26);
        }

        // add final number in quotient
        $results[] = $this->letters[$number];

        // convert final array to string and reverse
        $result = strrev(implode($results));

        return $result;
    }


}
