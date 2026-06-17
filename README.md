# 商品管理アプリ

## 概要

商品の登録・編集・削除・検索を行うためのアプリです。

## 使用技術

- PHP 8.4
- Laravel 13
- MySQL 8
- Docker
- Laravel Sail
- Bootstrap

## 機能一覧

- 商品一覧
- 商品検索
- 商品登録
- 商品編集
- 商品削除
- カテゴリ管理

## ER図

（ER図画像）

## 画面イメージ

（スクリーンショット）

## セットアップ

### リポジトリを取得

git clone ○○

### ディレクトリ移動

cd product-management-app

### コンテナ起動

docker compose up -d

### Composerインストール

./vendor/bin/sail composer install

### APP_KEY生成

./vendor/bin/sail artisan key:generate

### マイグレーション

./vendor/bin/sail artisan migrate --seed