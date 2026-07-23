<x-layout title="注文履歴">
    @forelse ($orders as $order)
        <div class="card shadow-sm mb-3">
            <div class="card-body">
                <div class="row align-items-center">
                    <div class="col-md-3">
                        <div class="text-muted small">注文番号</div>
                        <div class="fw-bold">#{{ $order->id }}</div>
                    </div>
                    <div class="col-md-3">
                        <div class="text-muted small">注文日時</div>
                        <div>{{ $order->created_at->format('Y/m/d H:i') }}</div>
                    </div>
                    <div class="col-md-3">
                        <div class="text-muted small">合計金額</div>
                        <div class="fw-bold">{{ number_format($order->total_price) }}円</div>
                    </div>
                    <div class="col-md-3 text-md-end mt-3 mt-md-0">
                        <a href="{{ route('orders.show', $order) }}" class="btn btn-outline-primary">
                            詳細を見る
                        </a>
                    </div>
                </div>
            </div>
        </div>
    @empty
        <div class="alert alert-secondary text-center">
            注文履歴がありません。
        </div>
    @endforelse

    <div class="mt-4">
        <a href="{{ route('products.index') }}" class="btn btn-outline-secondary">
            買い物を続ける
        </a>
    </div>
</x-layout>