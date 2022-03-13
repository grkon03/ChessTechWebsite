<?php
    session_start();
    $id = $_SESSION["id"];

    if ($id == "") {
        header("Location: ./login.php");
    }

    require_once("../../util/mysql.php");
    $sql_util = new MYSQL_UTIL();
    
    $member = $sql_util->GetMember($id);
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
                require_once("../../template/header_template.php");
                write_header(2);
            ?>
        </header>
        <div id="main">
            <div id="menu_page_main">
                <h2>予定を作成する</h2>
                <div id="regist_schedule" class="menu_page_mini">
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
                require_once("../../template/footer_template.php");
                write_footer(2);
            ?>
        </footer>
    </body>
</html>