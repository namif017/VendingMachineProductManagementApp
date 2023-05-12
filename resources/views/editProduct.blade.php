@extends('layouts.page')

@section('title', '商品情報編集画面')

@section('content')
<form action="{{ route('submitEditProduct', ['id' => $product->id]) }}" method="post" class="product-data-form" enctype="multipart/form-data">
    @csrf
        <div class="form-group">
            <label>商品情報ID</label>
            <span>{{ $product->id }}</span>
        </div>
        <div class="form-group">
            <label for="txtProductName">商品名</label>
            <input type="text" name="product_name" id="txtProductName" placeholder="商品名" value="{{ old('product_name', $product->product_name) }}">
                @if($errors->has('product_name'))
                    <p>{{ $errors->first('product_name') }}</p>
                @endif
        </div>
        <div class="form-group">
            <label for="selectCompany">メーカー</label>
            <select class="form-control" name="company_id" id="selectCompany">
                @foreach ($companies as $company)
                    <option value="{{ $company->id }}" @if($company->id == old('company_id', $product->company_id)) selected @endif>{{ $company->company_name }}</option>
                @endforeach
            </select>
                @if($errors->has('company_id'))
                    <p>{{ $errors->first('company_id') }}</p>
                @endif
        </div>
        <div class="form-group">
            <label for="numPlice">価格</label>
            <input type="number" name="price" id="numPlice" placeholder="価格" value="{{ old('price', $product->price) }}">
                @if($errors->has('price'))
                    <p>{{ $errors->first('price') }}</p>
                @endif
        </div>
        <div class="form-group">
            <label for="numStock">在庫数</label>
            <input type="number" name="stock" id="numStock" placeholder="在庫数" value="{{ old('stock', $product->stock) }}">
                @if($errors->has('stock'))
                    <p>{{ $errors->first('stock') }}</p>
                @endif
        </div>
        <div class="form-group">
            <label for="areaComment">コメント</label>
            <textarea name="comment" id="areaComment" placeholder="コメント">{{ old('comment', $product->comment) }}</textarea>
                @if($errors->has('comment'))
                    <p>{{ $errors->first('comment') }}</p>
                @endif
        </div>
        <div class="form-group">
            <label for="fileImg">商品画像</label>
            <input type="file" accept="image/*" name="img" id="fileImg" value="{{ old('img', $product->img_path) }}">
                @if($errors->has('img'))
                    <p>{{ $errors->first('img') }}</p>
                @endif
        </div>
        <button type="submit">更新</button>
    </form>
    <button type="button" onclick="window.location.href='{{ route('productDeteal', ['id' => $product->id]) }}'">戻る</button>
@endsection
