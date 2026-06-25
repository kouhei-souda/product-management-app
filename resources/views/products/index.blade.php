<x-layout title="商品一覧" heading="商品管理システム">
    <a href="{{ route('products.create') }}" class="btn btn-primary mt-3">商品登録</a>
    <form method="GET" action="">
        <div class="d-flex align-items-center mt-3">
            <label class="me-2">商品名検索</label>
            <input type="text" name="search" class="form-control me-3" value="{{ request('search') }}" style="width: 250px;">
            <button type="submit" class="btn btn-secondary me-2">検索</button>
            <a href="{{ route('products.index') }}" class="btn btn-secondary">クリア</a>
        </div>
    </form>
    <table class="table">
        <thead>
            <tr>
                <th>画像</th><th>商品名</th><th>金額</th><th>在庫</th><th>カテゴリー名</th><th></th>
            </tr>
        </thead>
        <tbody>
            @forelse ($products as $product)
            <tr>
                <td>
                    <img src="{{ asset('storage/' .$product->image_path) }}" width="80">
                </td>
                <td>{{ $product->name }}</td>
                <td>{{ $product->price }}円</td>
                <td>{{ $product->stock }}個</td>
                <td>{{ $product->category->name }}</td>
                <td>
                    <a href="{{ route('products.show', $product) }}" class="btn btn-sm btn-link">詳細</a>
                    <a href="{{ route('products.edit', $product) }}" class="btn btn-sm btn-link">編集</a>
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="5" class="text-danger fw-bold">
                    該当する商品が見つかりませんでした
                </td>
            </tr>
            @endforelse
        </tbody>
    </table>
    {{ $products->links() }}
</x-layout>