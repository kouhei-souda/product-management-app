<x-layout title="商品詳細">
    <div class="row g-4">
        <div class="col-lg-6">
            <div class="card shadow-sm">
                <div class="card-body text-center p-4">
                    @if ($product->image_path)
                        <img
                            src="{{ asset('storage/' .$product->image_path) }}"
                            alt="{{ $product->name }}"
                            class="img-fluid rounded"
                            style="max-width: 300px">
                    @endif
                </div>
            </div>
        </div>
        <div class="col-lg-6">
            <div class="card shadow-sm">
                <div class="card-header fw-bold">商品情報</div>
                <div class="card-body">
                    <div class="mb-3">
                        <div class="text-muted small">商品名</div>
                        <div>{{ $product->name }}</div>
                    </div>

                    <div class="mb-3">
                        <div class="text-muted small">価格</div>
                        <div>{{ number_format($product->price) }}円</div>
                    </div>

                    <div class="mb-3">
                        <div class="text-muted small">在庫状況</div>
                        <div>
                            @if ($product->stock > 5)
                                <span class="badge bg-success">在庫あり</span>
                            @elseif ($product->stock > 0)
                                <span class="badge bg-warning">残りわずか</span>
                            @else
                                <span class="text-danger">在庫切れ</span>
                            @endif
                        </div>
                    </div>

                    <div class="mb-3">
                        <div class="text-muted small">カテゴリー名</div>
                        <div>{{ $product->category->name }}</div>
                    </div>

                    <div class="mb-3">
                        <div class="text-muted small mb-2">商品説明</div>
                        <div class="border rounded bg-light p-3">{{ $product->description }}</div>
                    </div>

                    <hr>

                    <form action="{{ route('cart.store') }}" method="POST">
                        @csrf
                        <input type="hidden" name="product_id" value="{{ $product->id }}">

                        <div class="mb-3" style="max-width: 120px;">
                            <label class="form-label">数量</label>
                            <input
                                type="number"
                                name="quantity"
                                value="1"
                                min="1"
                                class="form-control">
                        </div>
                        <div class="d-flex gap-2">
                            <button
                                type="submit"
                                class="btn btn-primary"
                                @disabled($product->stock === 0)>
                                カートに入れる
                            </button>
                            <a href="{{ route('products.index') }}" class="btn btn-outline-secondary ms-2">商品一覧へ戻る</a>
                        </div>

                    </form>

                </div>
            </div>
        </div>
    </div>
</x-layout>