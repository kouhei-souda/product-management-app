<x-layout title="注文完了">
    <div class="row justify-content-center">
        <div class="col-lg-6">
            <div class="card shadow-sm">
                <div class="card-body text-center p-5">
                    <div class="display-1 text-success mb-3">
                        ✓
                    </div>

                    <h2 class="mb-3">ご注文ありがとうございました！</h2>

                    <p class="text-muted mb-4">
                        ご注文を受け付けました。<br>
                        注文履歴からご注文内容をご確認いただけます。
                    </p>

                    <div class="d-grid gap-2">
                        <a href="{{ route('orders.index') }}" class="btn btn-success">
                            注文履歴を見る
                        </a>

                        <a href="{{ route('products.index') }}" class="btn btn-outline-secondary">
                            買い物を続ける
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-layout>