# 商品管理アプリ

Laravelで作成した商品管理アプリです。

## 機能

* 商品一覧表示
* 商品検索（部分一致）
* 商品登録
* 商品詳細表示
* 商品編集
* 商品削除
* ページネーション
* カテゴリ管理

## 使用技術

* PHP 8.4
* Laravel 13
* MySQL 8.4
* Docker
* Bootstrap

## 環境構築

### 前提条件

以下がインストールされていること

* Git
* Docker Desktop

### 1. リポジトリをクローン

```bash
git clone https://github.com/kouhei-souda/product-management-app.git
cd product-management-app
```

### 2. Dockerコンテナを起動

```bash
docker compose up -d --build
```

### 3. appコンテナへ接続

```bash
docker compose exec app bash
```

### 4. Composerパッケージをインストール

```bash
composer install
```

### 5. 環境変数ファイルを作成

```bash
cp .env.example .env
```

### 6. アプリケーションキーを生成

```bash
php artisan key:generate
```

### 7. データベースを作成

```bash
php artisan migrate:fresh --seed
```

### 8. Laravel開発サーバーを起動

```bash
php artisan serve --host=0.0.0.0 --port=8000
```

### 9. アプリへアクセス

ブラウザで以下へアクセスしてください。

```text
http://localhost:8000
```

## データベース設定

本プロジェクトでは Docker Compose の MySQL コンテナを使用しています。

`.env.example` には以下の設定が含まれています。

```env
DB_CONNECTION=mysql
DB_HOST=mysql
DB_PORT=3306
DB_DATABASE=laravel
DB_USERNAME=laravel
DB_PASSWORD=password
```

## コンテナ停止

```bash
docker compose down
```

## ディレクトリ構成

```text
.
├── app
├── database
├── docker
│   └── php
│       └── Dockerfile
├── resources
├── routes
├── compose.yaml
└── README.md
```

## 今後の改善予定

* バリデーション強化
* ログイン機能
* 権限管理機能
* ECサイト風UIへの改修
* カート機能
* 注文機能
* 決済機能
