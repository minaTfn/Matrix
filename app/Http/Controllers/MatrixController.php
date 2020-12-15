<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Helpers\MatrixDisplay;
use App\Helpers\ExcelMatrixDisplay;
use App\Helpers\Matrix;
use Illuminate\Http\Request;

class MatrixController extends Controller
{

    /**
     * @param Request $request
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function multiply(Request $request)
    {

        try {
            list($matrix1, $matrix2) = self::verify($request);

            $resultMatrix = $matrix1->multiply($matrix2);

            $excelFormat = new MatrixDisplay(new ExcelMatrixDisplay());

            return response()->json([
                'result' => $excelFormat->display($resultMatrix),
                'success' => true,
            ], 200);

        } catch (\Exception $e) {

            return response()->json([
                'message' => $e->getMessage(),
                'success' => false,
            ], 400);
        }

    }

    /**
     * verify matrices to be multiplicable and not null
     *
     * @param $request
     *
     * @return array
     */
    private static function verify($request): array
    {

        $matrix1 = $request['matrix1'] ?? null;
        $matrix2 = $request['matrix2'] ?? null;

        abort_if(! $matrix1 || ! $matrix2, 400, "Two valid Matrices must be provided including matrix1 and matrix2.");

        $matrix1 = new Matrix($matrix1);
        $matrix2 = new Matrix($matrix2);

        abort_unless(Matrix::multiplicable($matrix1, $matrix2), 400, "Matrices are not multiplicable.");

        return [$matrix1, $matrix2];

    }

}
