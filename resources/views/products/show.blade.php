<x-layout title="商品詳細">
    @if ($product->image_path)
    <div class="mb-4">
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
            在庫状況
        </dt>
        <dd class="col-sm-10">
            @if ($product->stock > 5)
                在庫あり
            @elseif ($product->stock > 0)
                残りわずか
            @else
                <span class="text-danger">在庫切れ</span>
            @endif
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
    <form action="{{ route('cart.store') }}" method="POST" class="mt-4">
        @csrf
        <input type="hidden" name="product_id" value="{{ $product->id }}">

        <div class="mb-3" style="max-width: 120px;">
            <label class="form-label">数量</label>
            <input
                type="number"
                name="quantity"
                value="1"
                min="1"
                max="{{ $product->stock }}"
                class="form-control">
        </div>
        <button
            type="submit"
            class="btn btn-primary"
            @disabled($product->stock === 0)>
            カートに入れる
        </button>
        <a href="{{ route('products.index') }}" class="btn btn-secondary ms-2">戻る</a>
    </form>
</x-layout>