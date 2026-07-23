<x-layout title="注文確認">
    <div class="row">
        {{-- 配送先 --}}
        <div class="col-lg-8">
            <div class="card shadow-sm mb-4">
                <div class="card-header fw-bold">お届け先</div>
                <div class="card-body">
                    <div class="mb-3">
                        <div class="text-muted small">氏名</div>
                        <div>{{ $user->name }}</div>
                    </div>
                    <div class="mb-3">
                        <div class="text-muted small">メールアドレス</div>
                        <div>{{ $user->email }}</div>
                    </div>
                    <div class="mb-3">
                        <div class="text-muted small">電話番号</div>
                        <div>{{ $user->phone }}</div>
                    </div>
                    <div class="mb-3">
                        <div class="text-muted small">郵便番号</div>
                        <div>〒{{ $user->postal_code }}</div>
                    </div>
                    <div>
                        <div class="text-muted small">住所</div>
                        <div>
                            {{ $user->prefecture }}
                            {{ $user->city }}
                            {{ $user->address }}
                            {{ $user->building }}
                        </div>
                    </div>
                </div>
            </div>
        </div>

        {{-- 注文内容 --}}
        <div class="col-lg-4">
            <div class="card shadow-sm mb-4">
                <div class="card-header fw-bold">ご注文商品</div>
                <div class="card-body">
                    @forelse ($products as $product)
                        <div class="d-flex align-items-center border-bottom pb-3 mb-3">
                            @if ($product->image_path)
                                <img
                                    src="{{ asset('storage/' . $product->image_path) }}"
                                    class="rounded me-3"
                                    style="width:70px;height:70px;object-fit:cover;"
                                    alt="{{ $product->name }}">
                            @endif
                            <div class="flex-grow-1">
                                <div class="fw-bold">{{ $product->name }}</div>
                                <div class="small text-muted">{{ number_format($product->price) }}円</div>
                                <div class="d-flex justify-content-between mt-2">
                                    <span>数量：{{ $cart[$product->id]['quantity'] }}</span>
                                    <span class="fw-bold">
                                        {{ number_format($product->price * $cart[$product->id]['quantity']) }}円
                                    </span>
                                </div>
                            </div>
                        </div>
                    @empty
                        <div class="text-danger text-center">カートに商品がありません</div>
                    @endforelse

                    <div class="d-flex justify-content-between">
                        <span>商品合計</span>
                        <span>{{ number_format($total) }}円</span>
                    </div>

                    <div class="d-flex justify-content-between mt-2">
                        <span>送料</span>
                        <span>無料</span>
                    </div>

                    <hr>

                    <div class="d-flex justify-content-between fw-bold fs-5">
                        <span>合計</span>
                        <span>{{ number_format($total) }}円</span>
                    </div>

                    <form action="{{ route('orders.store') }}" method="POST" class="mt-4">
                        @csrf
                        <div class="d-grid">
                            <button
                                type="submit"
                                class="btn btn-success btn-lg">
                                注文を確定する
                            </button>
                        </div>
                    </form>
                </div>
            </div>
            <a href="{{ route('cart.index') }}" class="btn btn-outline-secondary">カートへ戻る</a>
        </div>
    </div>
</x-layout>