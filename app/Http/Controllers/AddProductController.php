<?php

namespace App\Http\Controllers;

use App\Models\Products;
use App\Http\Requests\ProductRequest;
use Illuminate\Support\Facades\DB;

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
        try {
            Products::registProduct($request);
            DB::commit();
        } catch (Exception $e) {
            DB::rollback();
            return back();
        }

        return redirect(route('addProduct'));
    }
}
