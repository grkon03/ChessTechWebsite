<?php
    session_start();

    $logined = isset($_SESSION["id"]);

    require_once("../util/mysql.php");

    $sql_util = new MYSQL_UTIL();

    if ($logined) {
        $id = $_SESSION["id"];

        $member = $sql_util->GetMember($id);
    }
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta name="description" content="東工大チェスサークルChessTechの活動予定カレンダーのページです。">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link href="./../css/setting.css" rel="stylesheet">
        <link href="./../css/header.css" rel="stylesheet">
        <link href="./../css/footer.css" rel="stylesheet">
        <link href="./../css/main/calender/detail.css" rel="stylesheet">
        <script>console.log("prevent Google Chrome css Transition");</script>
        <title>Calender | 東工大チェスサークル ChessTech</title>
    </head>
    <body>
        <header>
            <?php
                require_once("../template/header_template.php");
                write_header(1);
            ?>
        </header>
        <div id="main">
            <div id="detail">
            <?php
                $NotSeletedId = false;
                $NotExistId = false;
                $sch = new Schedule();
                if (!isset($_GET["id"])) {
                    $NotSelectedId = true;
                } else if (($sch = $sql_util->GetSchedule($_GET["id"])) === null) {
                    $NotExistId = true;
                }

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
                    $start = $sch->date_start->format("Y/m/d H:i:s");
                    $end = $sch->date_end->format("Y/m/d H:i:s");
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
                                <td>{$sch->members_join}</td>
                            </tr>
                            <tr>
                                <th>不参加者</th>
                                <td>{$sch->members_notjoin}</td>
                            </tr>
                        </tbody>
                    </table>
EOF;
                }
            ?>
                <div id="detail_decide_joinable">
                    <p id="detail_joinable_message">
                        あなたは現在「
                        <span id="detail_joinable_state_T">参加</span>
                        <span id="detail_joinable_state_F">不参加</span>
                        」に登録されています。
                    </p>
                    <form action="./detail.php?id=<?php echo $sch->id; ?>" method="POST" id="detail_decide_joinable_form_true">
                        <input type="hidden" name="joinable" value="T">
                        <input type="submit" value="参加">
                    </form>
                    <form action="./detail.php?id=<?php echo $sch->id; ?>" method="POST" id="detail_decide_joinable_form_false">
                        <input type="hidden" name="joinable" value="F">
                        <input type="submit" value="不参加">
                    </form>
                </div>
            </div>
        </div>
        <footer>
            <?php
                require_once("../template/footer_template.php");
                write_footer(1);
            ?>
        </footer>
    </body>
</html>