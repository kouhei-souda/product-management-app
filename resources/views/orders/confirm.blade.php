<x-layout title="注文確認">
    <table class="table align-middle">
        <thead>
            <tr>
                <th></th><th>商品</th><th>価格</th><th>数量</th><th>小計</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($products as $product)
            <tr>
                <td>
                    @if ($product->image_path)
                        <img src="{{ asset('storage/' . $product->image_path) }}"
                        alt="{{ $product->name }}"
                        style="width: 80px; height: auto;">
                    @endif
                </td>
                <td>{{ $product->name }}</td>
                <td>{{ number_format($product->price) }}円</td>
                <td>{{ $cart[$product->id]['quantity']}}</td>
                <td>{{ number_format($product->price * $cart[$product->id]['quantity']) }}円</td>
            </tr>
            @empty
            <tr>
                <td colspan="5" class="text-danger fw-bold">
                    カートに商品がありません
                </td>
            </tr>
            @endforelse
        </tbody>
    </table>
    <div class="d-flex justify-content-between align-items-center mt-3">
        <a href="{{ route('cart.index') }}" class="btn btn-secondary">カートへ戻る</a>
        <div>
            <h4 class="mb-3">合計金額：{{ number_format($total) }}円</h4>

            <form action="{{ route('orders.store') }}" method="POST">
                @csrf
                <button type="submit" class="btn btn-success">注文確定</button>
            </form>
        </div>
    </div>
</x-layout>