<?php
    $dsn = 'mysql:dbname=db_chesstech;host=mysql;port=3306;charset=utf8';
    $user = 'user';
    $password = 'password';

    try {
        $pdo = new PDO($dsn, $user, $password);
        echo "接続成功<br />";
        $tables = $pdo->query("SHOW TABLES");
        while($re = $tables->fetch(PDO::FETCH_ASSOC)){
            var_dump($re);
        }
    } catch (PDOException $e) {
        echo "接続失敗: " . $e->getMessage() . "\n";
        exit();
    }
?>