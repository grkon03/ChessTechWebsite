<?php
    $dsn = 'mysql:dbname=db_chesstech;host=mysql;port=3306;charset=utf8';
    $user = 'user';
    $password = 'password';
    require("./../util/mysql.php");

    try {
        
        $sql_util = new MYSQL_UTIL();
        $s = new Schedule();
        /*
        $s->name = "テストイベント2";
        $s->date_start = new DateTime("2021-12-31 00:00:00");
        $s->date_end = new DateTime("2021-12-31 12:00:00");
        $s->detail = "テスト用のイベント2です";
        $s->members_join = "";
        $s->members_notjoin = "grkon";
        //$sql_util->CreateSchedule($s);
        //$data = $sql_util->GetAllSchedules();
        $sql = "SELECT * FROM Schedules";

        $res = $sql_util->pdo->query($sql);
        $data = $res->fetchAll();
        var_dump($data);
        */
        /*
        $data = $sql_util->GetAllSchedules();
        var_dump($data);
        */
        /*
        $m = new Member();
        $m->id = "grkon";
        $m->pass = "yasu0u327";
        $m->name = "安田桜輔";
        $m->handle_name = "grkon";
        $m->grade = "21B";
        $m->authority = 1;
        $m->position = "部長,在籍中";
        $sql_util->CreateMember($m);
        */
        $upd_m = new Member();
        $upd_m->id = "grkon";
        $upd_m->authority = 2;
        $sql_util->UpdateMember($upd_m);
    } catch (PDOException $e) {
        echo "接続失敗: " . $e->getMessage() . "\n";
        exit();
    } catch (ErrorException $e) {
        echo "クエリ失敗:" . $e->getMessage() . "\n";
    }
?>