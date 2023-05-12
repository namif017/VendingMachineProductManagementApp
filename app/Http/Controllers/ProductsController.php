<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Products;
use LDAP\Result;

class ProductsController extends Controller
{
    public function showAllProducts() {
        return $this->showProducts('', 'all');
    }

    public function showSearchedProducts(Request $request) {
        return $this->showProducts($request->input('product_name_key'), $request->input('company_id'));
    }

    public function deleteProduct(Request $request) {
        $id = $request->input('id');
        $model = new Products();
        $model->deleteProduct($id);
        return redirect(route('products'));
    }

    function showProducts($product_name_key, $cpmpany_id) {
        $model = new Products();
        $companies = $model->getCompanies();
        $products = $model->getProducts($product_name_key, $cpmpany_id);
        return view('products', ['companies' => $companies, 'products' => $products]);
    }
}
