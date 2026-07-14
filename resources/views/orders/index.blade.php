<x-layout title="注文履歴">
    <table class="table align-middle">
        <thead>
            <tr>
                <th>注文番号</th><th>注文日時</th><th>合計金額</th><th>詳細</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($orders as $order)
            <tr>
                <td>{{ $order->id }}</td>
                <td>{{ $order->created_at }}</td>
                <td>{{ number_format($order->total_price) }}円</td>
                <td><a href="{{ route('orders.show', $order) }}" class="btn btn-secondary">詳細</a></td>
            </tr>
            @empty
            <tr>
                <td colspan="4" class="text-danger fw-bold">
                    注文履歴がありません
                </td>
            </tr>
            @endforelse
        </tbody>
    </table>
    <div class="d-flex justify-content-between align-items-center mt-3">
        <a href="{{ route('cart.index') }}" class="btn btn-secondary">カートへ戻る</a>
    </div>
</x-layout>