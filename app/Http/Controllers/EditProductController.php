<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProductRequest;
use App\Models\Products;
use Illuminate\Http\Request;

class EditProductController extends Controller
{
    public function showEditProduct(Request $request) {
        $id = $request->input('id');

        $model = new Products();
        $companies = $model->getCompanies();
        $product = $model->getProductDeteal($id);
        return view('editProduct', ['companies' => $companies, 'product' => $product]);
    }

    public function editProduct(ProductRequest $request) {
        $id = $request->input('id');

        $model = new Products();
        $model->editProduct($id, $request);

        return redirect(route('editProduct', ['id' => $id]));
    }
}
