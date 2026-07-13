<x-layout title="注文完了">
    <div class="text-center mt-5">
        <h2>ご注文ありがとうございます！</h2>
        <p>注文が完了しました。</p>

        <a href="{{ route('orders.index') }}" class="btn btn-primary">注文履歴を見る</a>

        <a href="{{ route('products.index') }}" class="btn btn-secondary">商品一覧へ戻る</a>
    </div>
</x-layout>