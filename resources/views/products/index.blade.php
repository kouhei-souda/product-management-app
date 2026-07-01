<x-layout title="商品一覧" heading="商品管理システム">
    <a href="{{ route('products.create') }}" class="btn btn-primary mt-3">商品登録</a>
    <form method="GET" action="">
        <div class="d-flex align-items-center mt-3">
            <label class="me-2">商品名</label>
            <input type="text" name="search" class="form-control me-2" value="{{ request('search') }}" style="width: 250px;">

            {{-- カテゴリー別 --}}
            <select name="category_id" id="category_id" class="me-2">
                <option value="">すべて</option>
                @foreach ($categories as $category)
                <option
                    value="{{ $category->id }}"
                    @selected(request('category_id') == $category->id)
                >
                    {{ $category->name }}
                </option>
                @endforeach
            </select>

            <button type="submit" class="btn btn-secondary me-2">検索</button>
            <a href="{{ route('products.index') }}" class="btn btn-secondary">クリア</a>
        </div>
    </form>

    {{-- カード化レイアウト --}}
    <div class="row mt-4">
        @forelse ($products as $product)
        <div class="col-6 col-md-3 mb-4">
            <div class="card h-100 shadow-sm">
                <img
                src="{{ asset('storage/' . $product->image_path) }}"
                class="card-img-top p-3"
                style="height:250px; object-fit:contain;"
                alt="{{ $product->name }}">

                <div class="card-body d-flex flex-column">
                    <h5 class="card-title">{{ $product->name }}</h5>

                    <p class="card-text mb-1">
                        <strong>価格：</strong>
                        {{ number_format($product->price) }}円
                    </p>

                    <p class="card-text mb-1">
                        <strong>在庫：</strong>
                        {{ $product->stock }}個
                    </p>

                    <p class="card-text mb-3">
                        <strong>カテゴリー：</strong>
                        {{ $product->category->name }}
                    </p>

                    <div class="mt-auto">
                        <a href="{{ route('products.show', $product) }}" class="btn btn-outline-primary btn-sm">詳細</a>
                        <a href="{{ route('products.edit', $product) }}" class="btn btn-outline-warning btn-sm">編集</a>
                    </div>
                </div>
            </div>
        </div>
        @empty
        <div class="col-12">
            <div class="alert alert-danger">
                該当する商品が見つかりませんでした
            </div>
        </div>
        @endforelse
    </div>
    {{-- <table class="table">
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
    </table> --}}
    {{ $products->links() }}
</x-layout>