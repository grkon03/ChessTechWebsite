<?php
    session_start();

    $logined = isset($_SESSION["id"]);

    require_once(dirname(__FILE__) . "/../util/mysql.php");

    $sql_util = new MYSQL_UTIL();

    if ($logined) {
        $id = $_SESSION["id"];

        $member = $sql_util->GetMember($id);
    }

    $NotSeletedId = false;
    $NotExistId = false;
    $sch = new Schedule();
    if (!isset($_GET["id"])) {
        $NotSelectedId = true;
    } else if (($sch = $sql_util->GetSchedule($_GET["id"])) === null) {
        $NotExistId = true;
    }
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta name="description" content="東工大チェスサークルChessTechのイベント詳細ページです。
            <?php
                if ($NotSelectedId) {
                    echo "イベントが指定されていません。";
                } else if ($NotExistId) {
                    echo "存在しないイベントIDです。";
                } else {
                    echo $sch->name . "の詳細についての情報はこのページから取得できます。";
                }
            ?>
        ">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link href="./../css/setting.css" rel="stylesheet">
        <link href="./../css/header.css" rel="stylesheet">
        <link href="./../css/footer.css" rel="stylesheet">
        <link href="./../css/main/calendar/detail.css" rel="stylesheet">
        <script>console.log("prevent Google Chrome css Transition");</script>
        <title>Calendar | 東工大チェスサークル ChessTech</title>
    </head>
    <body>
        <header>
            <?php
                require_once(dirname(__FILE__) . "/../template/header_template.php");
                write_header(1);
            ?>
        </header>
        <div id="main">
            <div id="detail">
            <?php

                if ($NotSelectedId) {
                    echo <<<EOF
                <h1>エラー</h1>
                <p>
                    イベントが指定されていません。<br /><br />
                    <a href="./">カレンダーに戻る</a>
                </p>
EOF;
                } else if ($NotExistId) {
                    echo <<<EOF
                <h1>エラー</h1>
                <p>
                    存在しないイベントIDです。<br /><br />
                    <a href="./">カレンダーに戻る</a>
                </p>
EOF;
                } else {
                    if (isset($_POST["joinable"])) {
                        $b_joinable = $_POST["joinable"] == "T" ? true : false;
                        $sql_util->RegistMemberSchedule($sch->id, $member->id, $b_joinable);
                    }
                    $sch = $sql_util->GetSchedule($_GET["id"]);

                    $start = $sch->date_start->format("Y/m/d H:i:s");
                    $end = $sch->date_end->format("Y/m/d H:i:s");

                    $members_join_arr = explode(",", $sch->members_join);
                    $members_notjoin_arr = explode(",", $sch->members_notjoin);
                    $members_join_hn_arr = array(); 
                    $members_notjoin_hn_arr = array();
                    foreach ($members_join_arr as $mid) {
                        $mem = $sql_util->GetMember($mid);
                        array_push($members_join_hn_arr, $mem->handle_name);
                    }
                    foreach ($members_notjoin_arr as $mid) {
                        $mem = $sql_util->GetMember($mid);
                        array_push($members_notjoin_hn_arr, $mem->handle_name);
                    }
                    
                    $members_join_hn_str = arrayToString($members_join_hn_arr);
                    $members_notjoin_hn_str = arrayToString($members_notjoin_hn_arr);

                    echo <<<EOF
                    <h1>{$sch->name}の詳細</h1>
                    <table id="detail_table">
                        <tbody>
                            <tr>
                                <th>イベント名</th>
                                <td>{$sch->name}</td>
                            </tr>
                            <tr>
                                <th>開始時間</th>
                                <td>{$start}</td>
                            </tr>
                            <tr>
                                <th>終了時間</th>
                                <td>{$end}</td>
                            </tr>
                            <tr>
                                <th>詳細説明</th>
                                <td>
                                {$sch->detail}
                                </td>
                            </tr>
                            <tr>
                                <th>参加者</th>
                                <td>{$members_join_hn_str}</td>
                            </tr>
                            <tr>
                                <th>不参加者</th>
                                <td>{$members_notjoin_hn_str}</td>
                            </tr>
                        </tbody>
                    </table>
EOF;
                }
            ?>
                <div id="detail_decide_joinable">
                    <?php
                        $detail_joinable_message = "";
                        $detail_decide_joinable_form = "";
                        if ($logined) {
                            $joinable = false;
                            $not_decided = false;

                            if (in_array($member->id, explode(",", $sch->members_join))) {
                                $joinable = true;
                            } else if (!in_array($member->id, explode(",", $sch->members_notjoin))) {
                                $not_decided = true;
                            }

                            if ($not_decided) {
                                $detail_joinable_message = <<<EOF
                                あなたは現在、参加/非参加を登録していません。
EOF;
                                $detail_decided_joinable_form = <<<EOF
                                <form action="./detail.php?id={$sch->id}" method="POST" id="detail_decide_joinable_form_true">
                                    <input type="hidden" name="joinable" value="T">
                                    <input type="submit" value="参加">
                                </form>
                                <form action="./detail.php?id={$sch->id}" method="POST" id="detail_decide_joinable_form_false">
                                    <input type="hidden" name="joinable" value="F">
                                    <input type="submit" value="不参加">
                                </form>
EOF;
                            } else if ($joinable) {
                                $detail_joinable_message = <<<EOF
                                あなたは現在「
                                <span id="detail_joinable_state_T">参加</span>
                                」に登録されています。下のボタンから不参加に変更できます。
EOF;
                                $detail_decided_joinable_form = <<<EOF
                                <form action="./detail.php?id={$sch->id}" method="POST" id="detail_decide_joinable_form_false">
                                    <input type="hidden" name="joinable" value="F">
                                    <input type="submit" value="不参加">
                                </form>
EOF;
                            } else {
                                $detail_joinable_message = <<<EOF
                                あなたは現在「
                                <span id="detail_joinable_state_F">不参加</span>
                                」に登録されています。下のボタンから参加に変更できます。
EOF;
                                $detail_decided_joinable_form = <<<EOF
                                <form action="./detail.php?id={$sch->id}" method="POST" id="detail_decide_joinable_form_true">
                                    <input type="hidden" name="joinable" value="T">
                                    <input type="submit" value="参加">
                                </form>
EOF;
                            }
                        } else {
                            $detail_joinable_message = <<<EOF
                                あなたはログインしていません。参加/非参加の登録をする場合は、ログインしてください。<br />
                                <a id="detail_decide_joinable_login"
                                    href="../menu/login.php?link=../calendar/detail.php?id={$sch->id}">
                                    Login
                                </a>
EOF;
                        }
                        echo <<<EOF
                        <p id="detail_joinable_message">
                            {$detail_joinable_message}
                        </p>
                        {$detail_decided_joinable_form}
EOF;
                    ?>
                </div>
            </div>
        </div>
        <footer>
            <?php
                require_once(dirname(__FILE__) . "/../template/footer_template.php");
                write_footer(1);
            ?>
        </footer>
    </body>
</html>