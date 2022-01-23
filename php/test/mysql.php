<?php
    $dsn = 'mysql:dbname=db_chesstech;host=mysql;port=3306;charset=utf8';
    $user = 'user';
    $password = 'password';
    require("./../util/mysql.php");

    try {
        
        $sql_util = new MYSQL_UTIL();
        $s = new Schedule();
        
        /*
        $s->name = "テストイベント6";
        $s->date_start = new DateTime("2021-12-31 18:00:00");
        $s->date_end = new DateTime("2022-02-02 20:00:00");
        $s->detail = "テスト用のイベント6です";
        $s->members_join = "grkon";
        $s->members_notjoin = "";
        $sql_util->CreateSchedule($s);
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
        /*
        $upd_m = new Member();
        $upd_m->id = "grkon";
        $upd_m->authority = 2;
        $sql_util->UpdateMember($upd_m);
        */
        /*
        $data = $sql_util->GetSchedule(2112301);
        var_dump($data);
        */
        /*
        $sch = new Schedule();
        $sch->id = 21123103;
        $sch->date_start = new DateTime("2022-01-01 00:00:00");
        var_dump($sql_util->UpdateSchedule($sch));
        */
        /*
        $sql_util->DeleteMember("grkon");
        */
        /*
        $sql_util->DeleteSchedule(2112301);
        */
        /*
        $data = $sql_util->GetAllMembers();
        var_dump($data);
        */
        /*
        $sch = $sql_util->GetSchedulesBetween(new DateTime("2022-01-01"), new DateTime("2022-01-31"));
        echo "<pre>";
        var_dump($sch);
        echo "</pre>";
        */
        
        /*
        $joi_new = new JoinableDay();
        $joi_new->date = new DateTime("2022-02-22");
        $joi_new->joinable = "";
        $joi_new->maybe_joinable = "grkon";
        $joi_new->notjoinable = "";

        $sql_util->CreateJoinableDay($joi_new);
        */
        
        /*
        $joi = new JoinableDay();
        $joi->date = new DateTime("2022-02-22 00:00:00");
        $joi->joinable = "grkon";
        $joi->maybe_joinable = "";

        $sql_util->UpdateJoinableDay($joi);
        */

        
        //$sql_util->DeleteJoinableDay_MemberOfDay(new DateTime("2022-02-22 00:00:00"), "grkon");
        //$sql_util->DeleteJoinableDay_AllOfDay(new DateTime("2022-02-22 00:00:00"));
        
        $bind = new JoinableDay();
        $bind->date = new DateTime("2022-02-22 00:00:00");
        //$bind->joinable = "grkon";
        

        $jois = $sql_util->GetJoinableDays($bind);

        echo "<pre>";
        var_dump($jois);
        echo "</pre>";
    } catch (PDOException $e) {
        echo "接続失敗: " . $e->getMessage() . "\n";
        exit();
    } catch (ErrorException $e) {
        echo "クエリ失敗:" . $e->getMessage() . "\n";
    }
?>