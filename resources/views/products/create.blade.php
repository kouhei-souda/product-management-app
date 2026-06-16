<x-layout title="商品登録">
    <div class="row">
        <div class="col-md-6">
        <form method="POST" action="{{ route('products.store') }}">
            @csrf
            @include('products.form')
            <div class="form-group mt-3">
                <button type="submit" class="btn btn-primary">登録</button>
                <a href="{{ route('products.index') }}" class="btn btn-secondary">戻る</a>
            </div>
        </form>
        </div>
    </div>
</x-layout>
