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
    <div class="container mt-4">
        <h1>{{ $heading ?? $title }}</h1>
    {{ $slot }}
    </div>
</body>
</html>