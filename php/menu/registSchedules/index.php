<?php
    session_start();

    if (!isset($_SESSION["id"])) {
        header("Location: ./../login.php?link=../menu/registSchedules/");
    }

    $id = $_SESSION["id"];

    require_once(dirname(__FILE__) . "/../../util/mysql.php");
    $sql_util = new MYSQL_UTIL();
    
    $member = $sql_util->GetMember($id);

    if ($member->authority > 1) {
        header("Location: ./../index.php");
    }
?>
<!DOCTYPE html>
<html lang="ja">
    <head>
        <meta charset="utf-8">
        <meta name="description" content="東工大チェスサークルChessTechの部内メニューです。ここでは活動予定を作成できます。">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link href="./../../css/setting.css" rel="stylesheet">
        <link href="./../../css/header.css" rel="stylesheet">
        <link href="./../../css/footer.css" rel="stylesheet">
        <link href="./../../css/menu.css" rel="stylesheet">
        <link href="./../../css/main/menu/registSchedules/index.css" rel="stylesheet">
        <script>console.log("prevent Google Chrome css Transition");</script>
        <title>予定を登録する | 東工大チェスサークル ChessTech</title>
    </head>
    <body>
        <header>
            <?php
                require_once(dirname(__FILE__) . "/../../template/header_template.php");
                write_header(2);
            ?>
        </header>
        <div id="main">
            <div id="menu_page_main">
                <h2>予定を作成する</h2>
                <div id="view_convenience" class="menu_page_mini">
                    <h3>都合の合う日付を探す</h3>
                    <div id="view_convenience_table">
                        <table border="1">
                            <thead>
                                <tr>
                                    <th>日付</th>
                                    <th>活動可能</th>
                                    <th>予定未定</th>
                                    <th>活動不可</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                    $members = $sql_util->GetAllMembersExceptAdmin();
                                    $specified_correctly = isset($_GET["dstart"]) && preg_match('/\A[0-9]{4}-[0-9]{1,2}-[0-9]{1,2}\z/', $_GET["dstart"]);
                                    $date_store = new DateTime($specified_correctly ? $_GET["dstart"] : "now");
                                    $date_display = clone $date_store;
                                    for ($i = 0; $i < 30; $i++) {
                                        $week = 1;
                                        for ($j = 0; $j < intval($date_display->format("w")); $j++) {
                                            $week *= 2;
                                        }
                                        $no_joinable = 0;
                                        $no_maybe_joinable = 0;
                                        $no_notjoinable = 0;
                                        $bind = new JoinableDay();
                                        $bind->date = $date_display;
                                        $jois = $sql_util->GetJoinableDays($bind);
                                        $joinables = array();
                                        $maybe_joinables = array();
                                        $notjoinables = array();
                                        if ($jois != null) {
                                            $joinables = explode(",", $jois[0]->joinable);
                                            $maybe_joinables = explode(",", $jois[0]->maybe_joinable);
                                            $notjoinables = explode(",", $jois[0]->notjoinable);
                                        }

                                        foreach ($members as $m) {
                                            $I = $m->id;
                                            if (in_array($I, $joinables)) {
                                                $no_joinable++;
                                            } else if (in_array($I, $maybe_joinables)) {
                                                $no_maybe_joinable++;
                                            } else if (in_array($I, $notjoinables)) {
                                                $no_notjoinable++;
                                            } else if (($m->joinable_dayofweek & $week) != 0) {
                                                $no_joinable++;
                                            } else {
                                                $no_notjoinable++;
                                            }
                                        }

                                        $day = $date_display->format("Y/m/d");
                                        $day_forurl = $date_display->format("Y-m-d");
                                        echo <<<EOF
                                        <tr>
                                            <td><a href="./convenience.php?date={$day_forurl}">{$day}</a></td>
                                            <td>{$no_joinable}人</td>
                                            <td>{$no_maybe_joinable}人</td>
                                            <td>{$no_notjoinable}人</td>
                                        </tr>
EOF;
                                        $date_display->add(new DateInterval("P1D"));
                                    }
                                ?>
                            </tbody>
                        </table>
                    </div>
                    <a class="view_convenience_move" id="view_convenience_prev_30days" href="./?dstart=<?php
                        $ds = clone $date_store;
                        $ds->sub(new DateInterval("P30D"));
                        echo $ds->format("Y-m-d");
                    ?>">
                        前の30日
                    </a>
                    <a class="view_convenience_move" id="view_convenience_next_30days" href="./?dstart=<?php
                        $ds = clone $date_store;
                        $ds->add(new DateInterval("P30D"));
                        echo $ds->format("Y-m-d");
                    ?>">
                        次の30日
                    </a>
                </div>
                <div id="regist_schedule" class="menu_page_mini">
                    <h3>予定を作成する</h3>
                    <div id="regist_schedule_suc_mes">
                        <?php
                            if (isset($_POST["name"])) {
                                $sch = new Schedule();
                                $sch->name = $_POST["name"];
                                $sch->date_start = new DateTime($_POST["date_start_date"] . " " . $_POST["date_start_time"]);
                                $sch->date_end = new DateTime($_POST["date_end_date"] . " " . $_POST["date_end_time"]);
                                $sch->detail = $_POST["detail"];
                                $sch->members_join = "";
                                $sch->members_notjoin = "";

                                $suc = $sql_util->CreateSchedule($sch);

                                if ($suc) {
                                    echo "＊予定の作成に成功しました。";
                                } else {
                                    echo "＊予定の作成に失敗しました。";
                                }
                            }
                        ?>
                    </div>
                    <form id="regist_schedule_form" action="./" method="POST">
                        <table>
                            <tbody>
                                <tr>
                                    <th>
                                        イベント名
                                    </th>
                                    <td>
                                        <input type="text" name="name" required>
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        開始時刻
                                    </th>
                                    <td>
                                        <input type="date" name="date_start_date" required>
                                        <input type="time" name="date_start_time" required>
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        終了時刻
                                    </th>
                                    <td>
                                        <input type="date" name="date_end_date" required>
                                        <input type="time" name="date_end_time" required>
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        詳細
                                    </th>
                                    <td>
                                        <textarea name="detail" required></textarea>
                                    </td>
                                </tr>
                                <tr>
                                    <th id="regist_schedule_form_th_submit"></th>
                                    <td>
                                        <input type="submit" id="regist_schedule_form_submit">
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </form>
                </div>
            </div>
            <div id="menu_page_footer">
                <a href="../" id="back_to_menu">Menu に戻る</a>
            </div>
        </div>
        <footer>
            <?php
                require_once(dirname(__FILE__) . "/../../template/footer_template.php");
                write_footer(2);
            ?>
        </footer>
    </body>
</html>