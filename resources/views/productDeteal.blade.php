@extends('layouts.page')

@section('title', '商品情報詳細画面')

@section('content')
    <table class="product-deteal-table">
        <tbody>
            <tr>
                <th>id</th>
                <td>{{ $product->id }}</td>
            </tr>
            <tr>
                <th>商品画像</th>
                <td>{{ $product->img_path }}</td>
            </tr>
            <tr>
                <th>商品名</th>
                <td>{{ $product->product_name }}</td>
            </tr>
            <tr>
                <th>メーカー</th>
                <td>{{ $product->company_name }}</td>
            </tr>
            <tr>
                <th>価格</th>
                <td>{{ $product->price }}</td>
            </tr>
            <tr>
                <th>在庫数</th>
                <td>{{ $product->stock }}</td>              
            </tr>
            <tr>
                <th>コメント</th>
                <td>{{ $product->comment }}</td>
            </tr>
        </tbody>
    </table>
    <button type="button" onclick="window.location.href='{{ route('editProduct', ['id' => $product->id]) }}'">編集</button>
    <button type="button" onclick="window.location.href='{{ route('products') }}'">戻る</button>
@endsection
