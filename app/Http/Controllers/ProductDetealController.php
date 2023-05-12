<?php

namespace App\Http\Controllers;

use App\Models\Products;
use Illuminate\Http\Request;

class ProductDetealController extends Controller
{
    public function __construct(){
        $this->middleware('auth');
    }

    public function showProductDeteal(Request $request) {
        $id = $request->input('id');

        $model = new Products();
        $product = $model->getProductDeteal($id);
        return view('productDeteal', ['product' => $product]);
    }
}
