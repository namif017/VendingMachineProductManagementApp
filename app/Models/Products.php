<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use Exception;

class Products extends Model
{
    public static function getCompanies() {
        $companies = DB::table('companies')
            ->select('id', 'company_name')
            ->get()
            ->sortBy('company_name');

        return $companies;
    }

    public static function getProducts($product_name_key, $company_id, $price_limit_lower, $price_limit_upper, $stock_limit_lower, $stock_limit_upper) {
        $query = DB::table('products');

        if($product_name_key != '') $query = $query->where('product_name', 'like', "%{$product_name_key}%");
        if($company_id != 'all')    $query = $query->where('company_id', $company_id);
        if($price_limit_lower != '') $query = $query->where('price', '>=', $price_limit_lower);
        if($price_limit_upper != '') $query = $query->where('price', '<=', $price_limit_upper);
        if($stock_limit_lower != '') $query = $query->where('stock', '>=', $stock_limit_lower);
        if($stock_limit_upper != '') $query = $query->where('stock', '<=', $stock_limit_upper);

        $products = $query
            ->leftJoin('companies', 'company_id', '=', 'companies.id')
            ->select('products.id', 'product_name', 'price', 'stock', 'img_path', 'companies.company_name')
            ->get();
        return $products;
    }

    public static function getProductDeteal($id) {
        $product = DB::table('products')
            ->where('products.id', $id)
            ->leftjoin('companies', 'company_id', '=', 'companies.id')
            ->select('products.id', 'company_id', 'product_name', 'price', 'stock', 'comment', 'img_path', 'company_name')
            ->first();
        
        return $product;
    }

    public static function registProduct($data) {
        $img = $data->img ?? '';

        if($img != '') {
            $img = $data->file('img')->store('public/imgs');
            $img = substr($img, 7);
            $img = "storage/{$img}";
        }

        $data->img = $img;

        $now = Carbon::now();
        DB::table('products')
            ->insert([
                'company_id' => $data->company_id,
                'product_name' => $data->product_name,
                'price' => $data->price,
                'stock' => $data->stock,
                'comment' => $data->comment ?? '',
                'img_path' => $data->img,
                'created_at' => $now,
                'updated_at' => $now
            ]);
    }

    public static function editProduct($id, $data) {
        $oldImgPath = DB::table('products')
            ->where('id', $id)
            ->first()
            ->img_path;

        $img = $oldImgPath;
        
        if($data->file('img')) {
            if($oldImgPath == '')  {
                $img = $data->file('img')->store('public/imgs');
                $img = substr($img, 7);
                $img = "storage/{$img}";
            }
            else {
                $img_ = substr($img, 7);
                $data->file('img')->storeAs('public', $img_);
            }
        }

        $data->img = $img;

        $now = Carbon::now();
        DB::table('products')
            ->where('id', $id)
            ->update([
                'company_id' => $data->company_id,
                'product_name' => $data->product_name,
                'price' => $data->price,
                'stock' => $data->stock,
                'comment' => $data->comment ?? '',
                'img_path' => $data->img ?? '',
                'updated_at' => $now,
            ]);
    }

    public static function deleteProduct($id) {
        DB::table('products')
            ->where('id', $id)
            ->delete();
    }

    public static function saleProduct($id) {
        $stock = DB::table('products')
            ->where('id', $id)
            ->select('stock')
            ->first()
            ->stock;
        
        if($stock < 1) throw new Exception("在庫がありません");

        $now = Carbon::now();
        DB::table('sales')
            ->insert([
                'product_id' => $id,
                'created_at' => $now,
                'updated_at' => $now
            ]);
        
        $product = DB::table('products')
            ->where('id', $id);
        
        $product->decrement('stock', 1);
        $product->update([
                'updated_at' => $now,
            ]);

        return $product->select('id', 'product_name')->first();
    }
}
