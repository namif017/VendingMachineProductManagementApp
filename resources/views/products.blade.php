@extends('layouts.page')

@section('title', '商品一覧画面')

@section('content')
    <form action="{{ route('searchProducts') }}" method="post">
        @csrf
        <div class="form-group">
            <label for="textProductName">商品名</label>
            <input type="text" class="form-control" name="product_name_key" id="textProductName" placeholder="メーカー名">
        </div>
        <div class="form-group">
            <label for="selectCompany">メーカー名</label>
            <select class="form-control" name="company_id" id="selectCompany">
                <option value="all">すべて</option>
                @foreach ($companies as $company)
                    <option value="{{ $company->id }}">{{ $company->company_name }}</option>
                @endforeach
            </select>
        </div>
        <button type="submit">検索</button>
    </form>
    <button type="button" onclick="window.location.href='{{ route('addProduct') }}'">新規登録</button>
    <table>
        <thead>
            <tr>
                <th>id</th>
                <th>商品画像</th>
                <th>商品名</th>
                <th>価格</th>
                <th>在庫数</th>
                <th>メーカー名</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($products as $product)
                <tr>
                    <td>{{ $product->id }}</td>
                    <td></td>
                    <td>{{ $product->product_name }}</td>
                    <td>{{ $product->price }}</td>
                    <td>{{ $product->stock }}</td>
                    <td>{{ $product->company_name }}</td>
                    <td><button type="button" onclick="window.location.href='{{ route('productDeteal', ['id' => $product->id]) }}'">詳細</button></td>
                    <td></td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection
