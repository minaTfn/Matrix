<?php

namespace Tests\Unit;

use App\Helpers\MatrixDisplay;
use App\Helpers\ExcelMatrixDisplay;
use App\Helpers\Matrix;
use Tests\TestCase;

class MatrixDisplayExcelTest extends TestCase
{

    /** @test */
    public function it_can_convert_a_numeric_matrix_to_an_excel_format_matrix()
    {
        $numericMatrix = new Matrix([[2, 4, -5], [1, 2, 28]]);
        $resultArray = [['B', 'D', 'NaN'], ['A', 'B', 'AB']];

        $excelFormat = new MatrixDisplay(new ExcelMatrixDisplay());

        $this->assertEquals($resultArray, $excelFormat->display($numericMatrix));

    }

    /** @test */
    public function it_can_convert_numbers_to_excel_format()
    {
        $display = new ExcelMatrixDisplay();

        $this->assertEquals('NaN', $display->convertToExcelFormat(0));

        $this->assertEquals('NaN', $display->convertToExcelFormat(-2));

        $this->assertEquals('AZ', $display->convertToExcelFormat(52));

        $this->assertEquals('DZ', $display->convertToExcelFormat(130));

        $this->assertEquals('AAOTX', $display->convertToExcelFormat(485236));

        $this->assertEquals('KZFHJ', $display->convertToExcelFormat(5487986));

        $this->assertEquals('AB', $display->convertToExcelFormat(28));

        $this->assertEquals('AC', $display->convertToExcelFormat(29));

        $this->assertEquals('I', $display->convertToExcelFormat(9));

        $this->assertEquals('A', $display->convertToExcelFormat(1));

        $this->assertEquals('I', $display->convertToExcelFormat(9));

        $this->assertEquals('A', $display->convertToExcelFormat(1));

        $this->assertEquals('AA', $display->convertToExcelFormat(27));

    }
}
