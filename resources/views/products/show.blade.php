<x-layout title="商品詳細">
    @if ($product->image_path)
    <div class="mb-4 text-center">
        <img
        src="{{ asset('storage/' .$product->image_path) }}"
        alt="{{ $product->name }}"
        class="img-fluid"
        style="max-width: 300px"
        >
    </div>
    @endif
    <dl class="row">
        <dt class="col-sm-2">
            商品名
        </dt>
        <dd class="col-sm-10">
            {{ $product->name }}
        </dd>
        <dt class="col-sm-2">
            金額
        </dt>
        <dd class="col-sm-10">
            ¥{{ number_format(($product->price)) }}
        </dd>
        <dt class="col-sm-2">
            在庫
        </dt>
        <dd class="col-sm-10">
            {{ $product->stock }}
        </dd>
        <dt class="col-sm-2">
            カテゴリー名
        </dt>
        <dd class="col-sm-10">
            {{ $product->category->name }}
        </dd>
        <dt class="col-sm-2">
            商品説明
        </dt>
        <dd class="col-sm-10">
            {{ $product->description }}
        </dd>
    </dl>
    <form method="POST" action="{{ route('products.destroy', $product) }}">
        @csrf
        @method('DELETE')
        <a href="{{ route('products.index') }}" class="btn btn-secondary">一覧に戻る</a>
        <button type="submit" class="btn btn-danger" onclick="return confirm('削除しますか？')">削除</button>
    </form>
</x-layout>