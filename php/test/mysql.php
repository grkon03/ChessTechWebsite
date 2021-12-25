<?php
    $dsn = 'mysql:dbname=db_chesstech;host=mysql;port=3306;charset=utf8';
    $user = 'user';
    $password = 'password';
    require("./../util/mysql.php");

    try {
        $sql_util = new MYSQL_UTIL();
        $s = new Schedule();
        $s->name = "テストイベント";
        $s->date = new DateTime("2021-12-30 00:00:00");
        $s->detail = "テスト用のイベントです";
        $s->members_join = "grkon";
        $s->members_notjoin = "";
        $sql_util->CreateSchedule($s);
    } catch (PDOException $e) {
        echo "接続失敗: " . $e->getMessage() . "\n";
        exit();
    } catch (ErrorException $e) {
        echo "クエリ失敗:" . $e->getMessage() . "\n";
    }
?>