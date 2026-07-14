<x-layout title="注文詳細">
    <table class="table align-middle">
        <p>注文番号：{{ $order->id }}</p>
        <p>注文日時：{{ $order->created_at->format('Y/m/d H:i') }}</p>
        <thead>
            <tr>
                <th>商品</th><th>価格</th><th>数量</th><th>小計</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($orderItems as $orderItem)
            <tr>
                <td>{{ $orderItem->product->name }}</td>
                <td>{{ number_format($orderItem->price) }}円</td>
                <td>{{ $orderItem->quantity }}</td>
                <td>{{ number_format($orderItem->price * $orderItem->quantity) }}円</td>
            </tr>
            @endforeach
        </tbody>
    </table>
    <div class="text-end mt-3">
        <h4>合計金額：{{ number_format($order->total_price) }}円</h4>
    </div>
    <div class="d-flex justify-content-between align-items-center mt-3">
        <a href="{{ route('orders.index') }}" class="btn btn-secondary">注文履歴へ戻る</a>
    </div>
</x-layout>