@extends('layouts.page')

@section('title', '商品一覧画面')

@section('content')
    <form id="search-form">
        <div class="form-group">
            <label for="textProductName">商品名</label>
            <input type="text" class="form-control" name="product_name_key" id="textProductName" placeholder="商品名">
        </div>
        <div class="form-group">
            <label for="selectCompany">メーカー</label>
            <select class="form-control" name="company_id" id="selectCompany">
                <option value="all">すべて</option>
                @foreach ($companies as $company)
                    <option value="{{ $company->id }}">{{ $company->company_name }}</option>
                @endforeach
            </select>
        </div>
        <div class="form-group">
            <label>価格</label>
            <input type="number" class="form-control" name="price_limit_lower" id="numPriceLimitLower">
            ~
            <input type="number" class="form-control" name="price_limit_upper" id="numPriceLimitUpper">
        </div>
        <div class="form-group">
            <label>在庫数</label>
            <input type="number" class="form-control" name="stock_limit_lower" id="numStockLimitLower">
            ~
            <input type="number" class="form-control" name="stock_limit_upper" id="numStockLimitUpper">
        </div>
        <button type="button" onclick="getFilteredProducts()">検索</button>
    </form>
    <div>
        <label for="selectSortProductsSauce">並べ替え</label>
        <select id="selectSortProductsSauce" onchange="sortAndShowProducts()">
            <option value="id">id</option>
            <option value="product_name">商品名</option>
            <option value="price">価格</option>
            <option value="stock">在庫数</option>
            <option value="company_name">メーカー</option>
        </select>
    </div>
    <button type="button" onclick="window.location.href='{{ route('addProduct') }}'">新規登録</button>
    <table id="tableProducts">
        <thead>
            <tr>
                <th>id</th>
                <th>商品画像</th>
                <th>商品名</th>
                <th>価格</th>
                <th>在庫数</th>
                <th>メーカー</th>
                <th></th>
                <th></th>
            </tr>
        </thead>
        <tbody>
        </tbody>
    </table>
@endsection

@section('scripts')
    <script src="{{ asset('/js/Products.js') }}"></script>
@endsection
