
## Build Setup

```bash
# Dockerイメージを作成
$ docker-compose build

# Dockerを起動
# -d でバックグランド起動
$ docker-compose up -d

# 起動しているコンテナが表示される
$ docker ps
```

## Stop & Down
```bash
# コンテナの停止
$ docker-compose stop

# 開発環境を一旦クリーンにして、ゼロから作り直したい
$ docker-compose down
```

## Create Project
src以下にプロジェクトをクローンしてつくる場合は以下のコマンドを実行する必要はありません。
```bash
# appコンテナ（名称：laravel_app）に入ります
$ docker-compose exec app bash

# Laravelプロジェクト作成
$ composer create-project --prefer-dist laravel/laravel sentiment "10.*"

# Laravelプロジェクト移動
$ cd sentiment

# ストレージの権限変更
# 参考は777としていたが都合に合わせて設定した方が良くないか？
# そもそもこのタイミングで実行しないと困ることも無いはず
# なので77X と　Xはあえて記載していない
# 初期値は751 drwxr-xr-x  5 root root    160 Nov 14 15:18 storage

$ chmod 77X -R storage/

$ php artisan key:generate
```

## Connect DB
```bash
# docker-compose.ymlを参考に.envに記載する
DB_CONNECTION=mysql
DB_HOST=
DB_PORT=
DB_DATABASE=
DB_USERNAME=
DB_PASSWORD=
```

## Migration
```bash
# appコンテナ（名称：laravel_app）に入ります
docker exec -it laravel_app bash

# laravelプロジェクトに移動
$ cd yourproject/

# マイグレーション実行
$ php artisan migrate
```

## クリア
```
php artisan config:clear
```

### Operation Confirmation 
```
php artisan serve --host 0.0.0.0
```
http://localhost

http://127.0.0.1:8080

http://192.168.1.116

http://192.168.1.104



### reference
https://laraweb.net/environment/8651/

https://laraweb.net/environment/8652/

### official image
https://hub.docker.com/_/php

https://hub.docker.com/_/mysql

https://hub.docker.com/r/phpmyadmin/phpmyadmin/


## クローンの流れ
```
php artisan migrate
php artisan db:seed
```

## fortifyメールカスタマイズ参考
https://helog.jp/laravel/notification-text-mail/

## 日本語化参考

https://zenn.dev/imah/articles/864ff0e1f25589


## php.ini
https://labo.kon-ruri.co.jp/docker-edit-php-ini/


https://www.php.net/manual/ja/function.strpos.php
https://www.php.net/manual/ja/function.substr.php



### Docker for Mac うなり
CPU 使用率を上げるとおとなしくなった

# メンテナンスモード
例
```
php artisan down --render="errors::maintenance" --secret="dd72a4c43515"
```
*dd72a4c43515は任意の文字列　/dd72a4c43515でアクセスが可能