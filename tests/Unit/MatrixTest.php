<?php

namespace Tests\Unit;

use App\Helpers\Matrix;
use Tests\TestCase;

class MatrixTest extends TestCase
{

    /** @test */
    public function it_can_return_rows_of_a_matrix()
    {
        $matrix = $this->createMatrix(3, 4);

        $this->assertEquals($matrix->getRows(), 3);
    }

    /** @test */
    public function it_can_return_columns_of_a_matrix()
    {
        $matrix = $this->createMatrix(3, 4);

        $this->assertEquals($matrix->getColumns(), 4);
    }

    /** @test */
    public function it_can_check_if_it_is_multiplicable_to_another_matrix()
    {
        // multiplicable
        $matrix1 = $this->createMatrix(3, 4);
        $matrix2 = $this->createMatrix(4, 2);

        $this->assertTrue(Matrix::multiplicable($matrix1, $matrix2));

        // not multiplicable
        $matrix1 = $this->createMatrix(3, 4);
        $matrix2 = $this->createMatrix(6, 2);

        $this->assertFalse(Matrix::multiplicable($matrix1, $matrix2));

    }

    /** @test */
    public function it_will_throw_an_exception_if_any_or_one_matrix_provided_for_multiply()
    {

        $matrix1 = [[1, 2], [3, 2]];

        // one matrix provided
        $this->getJson(route('api.matrix.multiply', compact('matrix1')))->assertStatus(400);

        // no matrix provided
        $this->getJson(route('api.matrix.multiply'))->assertStatus(400);

    }

    /** @test */
    public function it_will_throw_an_exception_if_matrices_are_not_multiplicable()
    {

        $matrix1 = [[1, 2], [3, 2]];
        $matrix2 = [[1, 2], [3, 2], [6, 2]];

        $this->getJson(route('api.matrix.multiply', compact('matrix1','matrix2')))->assertStatus(400);

    }

    /**
     * the result matrix's rows count is equal to first matrix's rows
     * the result matrix's columns count is equal to second matrix's columns
     * @test
     */
    public function multiply_two_matrices_return_a_new_matrix()
    {

        $matrix1 = $this->createMatrix(3, 4);
        $matrix2 = $this->createMatrix(4, 2);

        $resultMatrix = $matrix1->multiply($matrix2);

        $this->assertEquals($resultMatrix->getRows(), $matrix1->getRows());
        $this->assertEquals($resultMatrix->getColumns(), $matrix2->getColumns());

    }

    /** @test */
    public function it_can_multiply_another_matrix_and_get_excel_format_result()
    {
        $matrix1 = [[2, 4, -5], [1, 2, 3]];
        $matrix2 = [[1, 2, 3], [2, -4, 5], [1, 0, 3]];

        $this->getJson(route('api.matrix.multiply', compact('matrix1', 'matrix2')))->assertJsonFragment([
            'result' => [["-F","H","V"],["-L","E","K"]]
        ]);

    }


    private function createMatrix($rows, $columns)
    {
        $resultMatrix = [];
        for ($i = 0; $i < $rows; $i++) {
            for ($j = 0; $j < $columns; $j++) {
                $resultMatrix[$i][$j] = rand(-5, 20);
            }
        }

        return new Matrix($resultMatrix);
    }
}
