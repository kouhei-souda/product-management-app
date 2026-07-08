<x-layout title="商品一覧" heading="商品管理システム">
    <x-slot:header>
        <a href="{{ route('admin.products.create') }}" class="btn btn-primary">＋商品を追加</a>
    </x-slot:header>

    {{-- 検索機能 --}}
    <form method="GET" action="">
        <div class="d-flex align-items-center mt-3">
            <label class="me-2">商品名</label>
            <input type="text" name="search" class="form-control me-2" value="{{ request('search') }}" style="width: 250px;">

            {{-- カテゴリー別 --}}
            <select name="category_id" id="category_id" class="form-select me-2" style="width: 150px;">
                {{-- デフォルト --}}
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

            {{-- ソート順 --}}
            <select name="sort" id="sort" class="form-select me-2" style="width: 150px;">
                {{-- デフォルト --}}
                <option value="">並び順を選択</option>

                <option value="newest" @selected(request('sort') == 'newest')>新着順</option>
                <option value="price_asc" @selected(request('sort') == 'price_asc')>価格が安い順</option>
                <option value="price_desc" @selected(request('sort') == 'price_desc')>価格が高い順</option>
                <option value="name_asc" @selected(request('sort') == 'name_asc')>商品名順</option>
            </select>

            <button type="submit" class="btn btn-secondary me-2">検索</button>
            <a href="{{ route('admin.products.index') }}" class="btn btn-secondary">クリア</a>
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
                        <a href="{{ route('admin.products.show', $product) }}" class="btn btn-outline-primary btn-sm">詳細</a>
                        <a href="{{ route('admin.products.edit', $product) }}" class="btn btn-outline-warning btn-sm">編集</a>
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

    {{ $products->links() }}

</x-layout>