<x-layout title="商品登録">
    <div class="row">
        <div class="col-md-6">
        <form method="POST" action="{{ route('products.store') }}" enctype="multipart/form-data">
            @csrf
            @include('products.form')
            <div class="form-group mt-2">
                <label for="image" class="control-label">商品画像：</label>
                <input type="file" id="image" name="image" class="from-control" accept="image/*">
            </div>
            <div class="form-group mt-3">
                <button type="submit" class="btn btn-primary">登録</button>
                <a href="{{ route('products.index') }}" class="btn btn-secondary">戻る</a>
            </div>
        </form>
        </div>
    </div>
</x-layout>
