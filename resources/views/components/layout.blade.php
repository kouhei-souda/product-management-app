@props([
    'title' => '商品管理システム',
    'heading' => null,
])
<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <title>{{ $title }}</title>
</head>
<body>
    <nav class="navbar navbar-expand-lg bg-body-tertiary mb-4">
        <div class="container">

            @auth
                @if (auth()->user()->is_admin)
                <a class="navbar-brand" href="{{ route('admin.products.index') }}">
                    Laravel EC
                </a>
                @else
                <a class="navbar-brand" href="{{ route('products.index') }}">
                    Laravel EC
                </a>
                @endif
            @else
                <a class="navbar-brand" href="{{ route('products.index') }}">
                    Laravel EC
                </a>
            @endauth

            <button class="navbar-toggler"
                    type="button"
                    data-bs-toggle="collapse"
                    data-bs-target="#navbarNav"
                    aria-controls="navbarNav"
                    aria-expanded="false"
                    aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            @auth
                <div class="collapse navbar-collapse" id="navbarNav">
                    <ul class="navbar-nav me-auto">

                        {{-- 管理者とユーザーでナブバーメニューを分ける --}}
                        @if (auth()->user()->is_admin)
                        <li class="nav-item">
                            <a href="{{ route('admin.products.index') }}" class="nav-link">
                                商品一覧
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('admin.dashboard') }}" class="nav-link">
                                ダッシュボード
                            </a>
                        </li>
                        @else
                        <li class="nav-item">
                            <a href="{{ route('products.index') }}" class="nav-link">
                                商品一覧
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('cart.index') }}" class="nav-link">
                                カート
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('orders.index') }}" class="nav-link">
                                注文履歴
                            </a>
                        </li>
                        @endif
                    </ul>
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit" class="btn btn-outline-secondary">
                            ログアウト
                        </button>
                    </form>
                </div>
            @endauth
        </div>
    </nav>

    <div class="container">
        <h1 class="mb-4">{{ $heading ?? $title }}</h1>

        {{ $header ?? '' }}

        {{ $slot }}
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>