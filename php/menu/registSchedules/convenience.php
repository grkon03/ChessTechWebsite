<?php
    session_start();
    $id = $_SESSION["id"];

    if ($id == "") {
        header("Location: ./../login.php?link=../menu/registSchedules/convenience.php?date=" . $_GET["date"]);
    }

    require_once(dirname(__FILE__) . "/../../util/mysql.php");
    require_once(dirname(__FILE__) . "/../../util/util.php");
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
        <meta name="description" content="東工大チェスサークルChessTechの部内メニューです。ここでは各部員の都合を確認できます。">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link href="./../../css/setting.css" rel="stylesheet">
        <link href="./../../css/header.css" rel="stylesheet">
        <link href="./../../css/footer.css" rel="stylesheet">
        <link href="./../../css/menu.css" rel="stylesheet">
        <link href="./../../css/main/menu/registSchedules/convenience.css" rel="stylesheet">
        <script>console.log("prevent Google Chrome css Transition");</script>

        <?php
            $title = "";
            $date = null;
            $specified_correctly = isset($_GET["date"]) && preg_match('/\A[0-9]{4}-[0-9]{1,2}-[0-9]{1,2}\z/', $_GET["date"]);
            if ($specified_correctly) {
                $date = new DateTime($_GET["date"]);
                $title = $date->format("Y/m/d") . "の各部員の都合";
            } else {
                $title =  "日付を指定してください。";
            }
        ?>
        <title><?php echo $title; ?> | 東工大チェスサークル ChessTech</title>
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
                <h2><?php echo $title; ?></h2>
                <div id="view_member_convenience" class="menu_page_mini">
                    <?php
                        if (!$specified_correctly) {
                            echo "日付を指定してください。";
                        } else {
                            $members = $sql_util->GetAllMembersExceptAdmin();
                            $week = 1;
                            for ($j = 0; $j < intval($date->format("w")); $j++) {
                                $week *= 2;
                            }
                            $bind = new JoinableDay();
                            $bind->date = $date;
                            $jois = $sql_util->GetJoinableDays($bind);
                            $joinables = array();
                            $maybe_joinables = array();
                            $notjoinables = array();
                            if ($jois != null) {
                                $joinables = explode(",", $jois[0]->joinable);
                                $maybe_joinables = explode(",", $jois[0]->maybe_joinable);
                                $notjoinables = explode(",", $jois[0]->notjoinable);
                            }

                            $joinables_merged = array();
                            $maybe_joinables_merged = array();
                            $notjoinables_merged = array();
                            foreach ($members as $m) {
                                $I = $m->id;
                                if (in_array($I, $joinables)) {
                                    array_push($joinables_merged, $m->handle_name);
                                } else if (in_array($I, $maybe_joinables)) {
                                    array_push($maybe_joinables_merged, $m->handle_name);
                                } else if (in_array($I, $notjoinables)) {
                                    array_push($notjoinables_merged, $m->handle_name);
                                } else if (($m->joinable_dayofweek & $week) != 0) {
                                    array_push($joinables_merged, $m->handle_name);
                                } else {
                                    array_push($notjoinables_merged, $m->handle_name);
                                }
                            }

                            $jm_str = arrayToString($joinables_merged);
                            $mjm_str = arrayToString($maybe_joinables_merged);
                            $njm_str = arrayToString($notjoinables_merged);

                            echo <<<EOF
                            <table>
                                <tbody>
                                    <tr>
                                        <th>参加可能</th>
                                        <td>{$jm_str}</td>
                                    </tr>
                                    <tr>
                                        <th>予定未定</th>
                                        <td>{$mjm_str}</td>
                                    </tr>
                                    <tr>
                                        <th>参加不可</th>
                                        <td>{$njm_str}</td>
                                    </tr>
                                </tbody>
                            </table>
EOF;
                        }
                    ?>
                    <a id="back_to_index" href="./?dstart=<?php
                        $dstart = new DateTime((new DateTime("now"))->format("Y-m-d"));
                        if ($specified_correctly) {
                            while (true) {
                                $dstart_next30 = clone $dstart;
                                $dstart_next30->add(new DateInterval("P30D"));
                                if ($date < $dstart) {
                                    $dstart->sub(new DateInterval("P30D"));
                                } else if ($date >= $dstart_next30) {
                                    $dstart->add(new DateInterval("P30D"));
                                } else {
                                    break;
                                }
                            }
                        }
                        echo $dstart->format("Y-m-d");
                    ?>">
                        予定作成に戻る
                    </a>
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