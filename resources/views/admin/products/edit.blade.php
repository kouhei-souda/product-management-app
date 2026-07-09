<x-layout title="商品編集">
    <div class="row">
        <div class="col-md-4">
        <form method="POST" action="{{ route('admin.products.update', $product) }}" enctype="multipart/form-data">
            @csrf
            @method('PATCH')
            @include('admin.products.form')
            @if ($product->image_path)
            <label class="form-label">現在の画像</label>
            <img
            src="{{ asset('storage/' .$product->image_path) }}"
            alt="{{ $product->name }}"
            width="250"
            class="mt-2"
            >
            @endif
            <div class="form-group mt-2">
                <label for="image" class="control-label">新しい画像：</label>
                <input type="file" id="image" name="image" class="form-control" accept="image/*">
            </div>
            <div class="form-group mt-2">
                <button type="submit" class="btn btn-primary">更新</button>
                <a href="{{ route('admin.products.index') }}" class="btn btn-secondary">一覧に戻る</a>
            </div>
        </form>
        </div>
    </div>

</x-layout>