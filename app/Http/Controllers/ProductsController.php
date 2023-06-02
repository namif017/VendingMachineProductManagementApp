<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Products;

class ProductsController extends Controller
{
    public function __construct(){
        $this->middleware('auth');
    }

    public static function showProducts() {
        $companies = Products::getCompanies();
        return view('products', ['companies' => $companies]);
    }

    public static function deleteProduct(Request $request) {
        $id = $request->input('id');

        try {
            Products::deleteProduct($id);
            DB::commit();
        } catch (Exception $e) {
            DB::rollback();
            return back();
        }

        return redirect(route('products'));
    }

    static function getFilteredProducts() {
        $product_name_key = request()->get('product_name_key');
        $company_id = request()->get('company_id');

        $products = Products::getProducts($product_name_key, $company_id);

        return response()->json(['products' => $products]);
    }
}
