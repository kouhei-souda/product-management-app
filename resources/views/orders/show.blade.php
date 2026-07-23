<x-layout title="注文詳細">
    <div class="row">
        <div class="col-lg-8">
            <div class="card shadow-sm mb-4">
                <div class="card-header fw-bold">注文情報</div>
                <div class="card-body">
                    <div>
                        <div class="text-muted small">注文番号</div>
                        <div>#{{ $order->id }}</div>
                    </div>
                    <div>
                        <div class="text-muted small">注文日時</div>
                        <div>{{ $order->created_at->format('Y/m/d H:i') }}</div>
                    </div>
                    <hr>
                    <div class="text-muted small">配送先</div>
                    <div>{{ $order->name }}</div>
                    <div>〒{{ $order->postal_code }}</div>
                    <div>
                        {{ $order->prefecture }}
                        {{ $order->city }}
                        {{ $order->address }}
                        {{ $order->building }}
                    </div>
                    <div>{{ $order->phone }}</div>
                    <hr>
                    <div class="text-muted small">メールアドレス</div>
                    <div>{{ $order->email }}</div>
                </div>
            </div>
        </div>
        <div class="col-lg-4">
            <div class="card shadow-sm mb-4">
                <div class="card-body">
                    @foreach ($orderItems as $orderItem)
                        <div class="d-flex align-items-center border-bottom pb-3 mb-3">
                            @if ($orderItem->product->image_path)
                                <img
                                    src="{{ asset('storage/' . $orderItem->product->image_path) }}"
                                    class="rounded me-3"
                                    style="width:70px;height:70px;object-fit:cover;"
                                    alt="{{ $orderItem->product->name }}">
                            @endif
                            <div class="flex-grow-1">
                                <div class="fw-bold">{{ $orderItem->product->name }}</div>
                                <div class="small text-muted">{{ number_format($orderItem->price) }}円</div>
                                <div class="d-flex justify-content-between mt-2">
                                    <span>数量：{{ $orderItem->quantity }}</span>
                                    <span class="fw-bold">
                                        {{ number_format($orderItem->price * $orderItem->quantity) }}円
                                    </span>
                                </div>
                            </div>
                        </div>
                    @endforeach
                    <div class="d-flex justify-content-between">
                        <span>商品合計</span>
                        <span>{{ number_format($order->total_price) }}円</span>
                    </div>

                    <div class="d-flex justify-content-between mt-2">
                        <span>送料</span>
                        <span>無料</span>
                    </div>
                    <hr>
                    <div class="d-flex justify-content-between fw-bold fs-5">
                        <span>合計</span>
                        <span>{{ number_format($order->total_price) }}円</span>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="d-flex justify-content-between align-items-center mt-3">
        <a href="{{ route('orders.index') }}" class="btn btn-secondary">注文履歴へ戻る</a>
    </div>
</x-layout>