<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Products;
use App\Http\Requests\ProductRequest;

class AddProductController extends Controller
{
    public function showAddProduct() {
        $model = new Products();
        $companies = $model->getCompanies();
        return view('addProduct',['companies' => $companies]);
    }

    public function registProduct(ProductRequest $request) {
        $model = new Products();
        $model->registProduct($request);

        return redirect(route('addProduct'));
    }
}
