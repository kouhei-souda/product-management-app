<x-layout title="商品編集">
    <div class="row">
        <div class="col-md-6">
        <form method="POST" action="{{ route('products.update', $product) }}">
            @csrf
            @method('PATCH')
            @include('products.form')
            <div class="form-group mt-2">
                <button type="submit" class="btn btn-primary">更新</button>
                <a href="{{ route('products.index') }}" class="btn btn-secondary">一覧に戻る</a>
            </div>
        </form>
        </div>
    </div>

</x-layout>