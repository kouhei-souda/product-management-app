<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            管理者ダッシュボード
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">

                <a href="{{ route('admin.products.index') }}"
                    class="bg-white shadow rounded-lg p-6 hover:bg-gray-50">

                    <h3 class="text-xl font-bold">
                        商品管理
                    </h3>

                    <p class="mt-2 text-gray-600">
                        商品一覧・登録・編集・削除
                    </p>

                </a>

                <div class="bg-white shadow rounded-lg p-6">
                    <h3 class="text-xl font-bold">
                        カテゴリ管理
                    </h3>

                    <p class="mt-2 text-gray-600">
                        準備中
                    </p>
                </div>

                <div class="bg-white shadow rounded-lg p-6">
                    <h3 class="text-xl font-bold">
                        注文管理
                    </h3>

                    <p class="mt-2 text-gray-600">
                        準備中
                    </p>
                </div>

                <div class="bg-white shadow rounded-lg p-6">
                    <h3 class="text-xl font-bold">
                        ユーザー管理
                    </h3>

                    <p class="mt-2 text-gray-600">
                        準備中
                    </p>
                </div>

            </div>

        </div>
    </div>
</x-app-layout>