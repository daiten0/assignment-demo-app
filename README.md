# アプリ起動手順
## 1. リポジトリをクローン
git clone https://github.com/yourname/assignment-demo-app.git
cd assignment-demo-app

## 2. 依存パッケージをインストール
composer install

## 3. データベース設定を確認
config/app_local.php内のDB接続情報を編集

## 4. マイグレーション実行（テーブル作成）
bin/cake migrations migrate

## 5. ローカルサーバー起動
bin/cake server

## 6. ブラウザで以下URLにアクセス
http://localhost:8765/

# アプリ仕様
初期画面にて解析したい画像を選択し、「解析する」ボタン押下でAI解析を行い、DBに解析結果を保存する。　※AI解析はmock-upとし、20%の確率でエラーを返却する。