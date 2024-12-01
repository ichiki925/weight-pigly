#確認テスト\_Pigly

## 環境構築

**Docker ビルド**

1. `git clone git@github.com:estra-inc/confirmation-test-contact-form.git`
2. DockerDesktop アプリを立ち上げる
3. `docker-compose up -d --build`

エラーが発生する場合は、docker-compose.yml ファイルの「mysql」内に「platform」の項目を追加で記載してください\*

```bash
mysql:
    platform: linux/x86_64(この文追加)
    image: mysql:8.0
    environment:
```

**Laravel 環境構築**

1. `docker-compose exec php bash`
2. `composer install`
3. 「.env.example」ファイルを 「.env」ファイルに命名を変更。または、新しく.env ファイルを作成
4. .env に以下の環境変数を追加

```text
DB_CONNECTION=mysql
DB_HOST=mysql
DB_PORT=3306
DB_DATABASE=laravel_db
DB_USERNAME=laravel_user
DB_PASSWORD=laravel_pass
```

5. アプリケーションキーの作成

```bash
php artisan key:generate
```

6. マイグレーションの実行

```bash
php artisan migrate
```

7. シーディングの実行

```bash
php artisan db:seed
```

## 使用技術(実行環境)

- PHP8.3.0
- Laravel8.83.27
- MySQL8.0

## ER 図

![ER Diagram](diagram.png)

## URL

- 開発環境：http://localhost/
- phpMyAdmin:：http://localhost:8080/
