<?php

namespace App\Http\Controllers;

use App\Commons\ManipulateDB;
use Illuminate\Http\Request;
use App\Models\Products;

class ProductsController extends Controller
{
    public function __construct(){
        $this->middleware('auth');
    }
    
    public static function showAllProducts() {
        return ProductsController::showProducts('', 'all');
    }

    public static function showSearchedProducts(Request $request) {
        return ProductsController::showProducts($request->input('product_name_key'), $request->input('company_id'));
    }

    public static function deleteProduct(Request $request) {
        $id = $request->input('id');

        $func = Products::deleteProduct($id);
        ManipulateDB::manipulateDB($func);

        return redirect(route('products'));
    }

    static function showProducts($product_name_key, $cpmpany_id) {
        $companies = Products::getCompanies();
        $products = Products::getProducts($product_name_key, $cpmpany_id);
        return view('products', ['companies' => $companies, 'products' => $products]);
    }
}
