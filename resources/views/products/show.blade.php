<x-layout title="商品詳細">
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
            {{ $product->price }}
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
    </dl>
    <form method="POST" action="{{ route('products.destroy', $product) }}">
        @csrf
        @method('DELETE')
        <a href="{{ route('products.index') }}" class="btn btn-secondary">一覧に戻る</a>
        <button type="submit" class="btn btn-danger" onclick="return confirm('削除しますか？')">削除</button>
    </form>
</x-layout>