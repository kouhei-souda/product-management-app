{{-- バリデーションエラーメッセージ表示 --}}
@if ($errors->any())
<div class="alert alert-danger">
<h5>{{$errors->count()}}件のエラーが発生しました。</h5>
<ul class="mb-0">
    @foreach ($errors->all() as $err)
    <li  class="text-danger">{{ $err }}</li>
    @endforeach
</ul>
</div>
@endif

<div class="form-group mt-2">
    <label for="name" class="control-label">商品名：</label>
    <input type="text" id="name" name="name" class="form-control" value="{{ old('name', $product->name) }}">
</div>
<div class="form-group mt-2">
    <label for="price" class="control-label">金額：</label>
    <input type="number" id="price" name="price" class="form-control" value="{{ old('price', $product->price) }}">
</div>
<div class="form-group mt-2">
    <label for="stock" class="control-label">在庫：</label>
    <input type="number" id="stock" name="stock" class="form-control" value="{{ old('stock', $product->stock) }}">
</div>
<div class="form-group mt-2">
    <label for="category_id" class="control-label">カテゴリー名：</label>
    <select name="category_id" id="category_id" class="form-select">
        @foreach ($categories as $category)
            <option value="{{ $category->id }}"
                @selected(old('category_id', $product->category_id) == $category->id)>
                {{ $category->name }}
            </option>
        @endforeach
    </select>
</div>
<div class="form-group mt-2">
    <label for="description" class="control-label">説明：</label>
    <textarea name="description" id="description" class="form-control" rows="3">{{ old('description', $product->description) }}</textarea>
</div>