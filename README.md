# ChessTechWebsite
東工大チェスサークルChessTechのウェブサイトです。以下にdocker-composeでの扱い方を書いておきます。
## 起動方法
```
$ docker-compose up -d
```
で立ち上げます。Dockerfileの変更があった場合は
```
$ docker-compose up -d --build
```
でリビルドしてください。
## MySQL関連
### エラー等
MySQLでテーブルが見つからないや、サーバーが見つからないといった類のエラーが起きた
```
$ docker-compose ps
```
でサーバーが立っているかを確認してください。MySQLのサーバーが更新されない場合は、
```yaml:docker-compose.yml
volumes:
    - ./mysql/db/data:/var/lib/mysql
```
を
```yaml:docker-compose.yml
volumes:
    #- ./mysql/db/data:/var/lib/mysql
```
とコメントアウトしてください。```docker-compose```が完了したら、コメントアウトを外してください。これでうまくいかない場合は、```./mysql/db/data```を削除してください。
### MySQLにログイン
MySQLにログインする場合は、
```
$ docker-compose exec mysql bash
```
とすると mysql のコンテナの bash に移るので
```
# mysql -u user -p
```
を実行してください。パスワードは```password```です。使用するテーブルは```db_chesstech```です。これを使用する場合は、
```
mysql> use db_chesstech;
```
を実行してください。