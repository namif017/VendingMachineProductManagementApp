<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class Products extends Model
{
    public function getCompanies() {
        $companies = DB::table('companies')
            ->select('id', 'company_name')
            ->get();
        return $companies;
    }

    public function getProducts($product_name_key, $company_id) {
        $query = DB::table('products');

        if($product_name_key != '') $query = $query->where('product_name', 'like', "%{$product_name_key}%");
        if($company_id != 'all')    $query = $query->where('company_id', $company_id);


        $products = $query
            ->leftJoin('companies', 'company_id', '=', 'companies.id')
            ->select('products.id', 'product_name', 'price', 'stock', 'img_path', 'companies.company_name')
            ->get();
        return $products;
    }

    public function getProductDeteal($id) {
        $product = DB::table('products')
            ->where('products.id', $id)
            ->leftjoin('companies', 'company_id', '=', 'companies.id')
            ->select('products.id', 'company_id', 'product_name', 'price', 'stock', 'comment', 'img_path', 'company_name')
            ->first();
        
        return $product;
    }

    public function registProduct($data) {
        $img = $data->img ?? '';

        if($img != '') {
            $img = $data->file('img')->store('public/imgs');
            $img = substr($img, 7);
            $img = "storage/{$img}";
        }

        $data->img = $img;

        $this->manipulateDB(function() use($data){
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
                'updated_at' => $now,
            ]);
        });
    }

    public function editProduct($id, $data) {
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
        
        $this->manipulateDB((function() use($id, $data) {
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
        }));
    }

    function deleteProduct($id) {
        $this->manipulateDB(function() use($id) {
            DB::table('products')
            ->where('id', $id)
            ->delete();
        });
    }

    function manipulateDB($func) {
        DB::beginTransaction();

        try {
            $func();
            DB::commit();
        } catch (Exception $e) {
            DB::rollback();
            return back();
        }
    }
}
