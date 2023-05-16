<?php

namespace App\Http\Controllers;

use App\Commons\ManipulateDB;
use App\Models\Products;
use App\Http\Requests\ProductRequest;

class AddProductController extends Controller
{
    public function __construct(){
        $this->middleware('auth');
    }

    public static function showAddProduct() {
        $companies = Products::getCompanies();
        return view('addProduct',['companies' => $companies]);
    }

    public static function registProduct(ProductRequest $request) {
        $func = Products::registProduct($request);
        ManipulateDB::manipulateDB($func);

        return redirect(route('addProduct'));
    }
}
