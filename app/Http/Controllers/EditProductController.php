<?php

namespace App\Http\Controllers;

use App\Commons\ManipulateDB;
use App\Http\Requests\ProductRequest;
use App\Models\Products;
use Illuminate\Http\Request;

class EditProductController extends Controller
{
    public function __construct(){
        $this->middleware('auth');
    }

    public static function showEditProduct(Request $request) {
        $id = $request->input('id');

        $companies = Products::getCompanies();
        $product = Products::getProductDeteal($id);
        return view('editProduct', ['companies' => $companies, 'product' => $product]);
    }

    public static function editProduct(ProductRequest $request) {
        $id = $request->input('id');

        $func = Products::editProduct($id, $request);
        ManipulateDB::manipulateDB(($func));

        return redirect(route('editProduct', ['id' => $id]));
    }
}
