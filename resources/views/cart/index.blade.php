<x-layout title="カート">

    {{-- メッセージ --}}
    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    @if (session('error'))
        <div class="alert alert-danger">
            {{ session('error') }}
        </div>
    @endif

    <div class="row">
        {{-- 商品一覧 --}}
        <div class="col-lg-8">
            <div class="card shadow-sm">
                <div class="card-header fw-bold">
                    カートの商品
                </div>
                <div class="card-body">
                    @forelse ($products as $product)
                        <div class="row align-items-center border-bottom py-3">
                            <div class="col-md-2">
                                @if ($product->image_path)
                                    <img
                                        src="{{ asset('storage/' . $product->image_path) }}"
                                        class="rounded"
                                        style="width:80px;height:80px;object-fit:cover;"
                                        alt="{{ $product->name }}">
                                @endif
                            </div>
                            <div class="col-md-4">
                                <h5 class="mb-1">{{ $product->name }}</h5>
                                <div class="text-muted">
                                    {{ number_format($product->price) }}円
                                </div>
                            </div>
                            <div class="col-md-3">
                                <form action="{{ route('cart.update', $product) }}" method="POST">
                                    @csrf
                                    @method('PATCH')
                                    <div class="input-group">
                                        <input
                                            type="number"
                                            name="quantity"
                                            class="form-control"
                                            min="1"
                                            value="{{ old('quantity', $cart[$product->id]['quantity']) }}">

                                        <button
                                            class="btn btn-outline-secondary"
                                            type="submit">
                                            更新
                                        </button>
                                    </div>
                                </form>
                            </div>
                            <div class="col-md-2 text-end fw-bold">
                                {{ number_format($product->price * $cart[$product->id]['quantity']) }}円
                            </div>
                            <div class="col-md-1 text-end">
                                <form action="{{ route('cart.destroy', $product) }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button
                                        class="btn btn-outline-danger btn-sm"
                                        onclick="return confirm('削除しますか？')">
                                        ×
                                    </button>
                                </form>
                            </div>
                        </div>
                    @empty
                        <div class="text-center text-danger py-5">
                            カートに商品がありません
                        </div>
                    @endforelse
                </div>
            </div>
        </div>

        {{-- 注文サマリー --}}
        <div class="col-lg-4">
            <div class="card shadow-sm">
                <div class="card-header fw-bold">
                    ご注文内容
                </div>
                <div class="card-body">
                    <div class="d-flex justify-content-between mb-2">
                        <span>商品合計</span>
                        <span>{{ number_format($total) }}円</span>
                    </div>
                    <div class="d-flex justify-content-between mb-3">
                        <span>送料</span>
                        <span>無料</span>
                    </div>
                    <hr>
                    <div class="d-flex justify-content-between fw-bold fs-5 mb-4">
                        <span>合計</span>
                        <span>{{ number_format($total) }}円</span>
                    </div>
                    <div class="d-grid mb-2">
                        <a href="{{ route('orders.confirm') }}"
                            class="btn btn-success">
                            注文確認へ
                        </a>
                    </div>
                    <div class="d-grid">
                        <a href="{{ route('products.index') }}"
                            class="btn btn-outline-secondary">
                            買い物を続ける
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-layout>