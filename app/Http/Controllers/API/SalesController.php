<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Symfony\Component\HttpFoundation\Request;

use App\Models\Products;
use Exception;

class SalesController extends Controller
{
    public function saleProduct(Request $request) {

        $product_id = $request->input('id');

        DB::beginTransaction();

       try {
            $product = Products::SaleProduct($product_id);
            DB::commit();

            $result = [
                'result' => true,
                'product' => $product
            ];
        } catch(Exception $e){
            DB::rollback();

            $result = [
                'result' => false,
                'error' => [
                    'messages' => [$e->getMessage()]
                ],
            ];
            return $this->resConversionJson($result, $e->getCode());
        }
        return $this->resConversionJson($result);
    }

    private function resConversionJson($result, $statusCode=200) {
        if(empty($statusCode) || $statusCode < 100 || $statusCode >= 600){
            $statusCode = 500;
        }
        return response()->json($result, $statusCode, ['Content-Type' => 'application/json'], JSON_UNESCAPED_SLASHES);
    }
}
