<?php
    session_start();

    $logined = isset($_SESSION["id"]);

    if ($logined) {
        $id = $_SESSION["id"];

        require_once("../util/mysql.php");

        $sql_util = new MYSQL_UTIL();

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
                <h1>イベント1の詳細</h1>
                <table id="detail_table">
                    <tbody>
                        <tr>
                            <th>イベント名</th>
                            <td>イベント1</td>
                        </tr>
                        <tr>
                            <th>開始時間</th>
                            <td>2022/06/12 20:00:00</td>
                        </tr>
                        <tr>
                            <th>終了時間</th>
                            <td>2022/06/12 21:00:00</td>
                        </tr>
                        <tr>
                            <th>詳細説明</th>
                            <td>詳細詳細詳細詳細詳細詳細詳細詳細詳細詳細詳細詳細詳細詳細詳細詳細詳細詳細
                            詳細詳細詳細詳細詳細詳細詳細詳細詳細詳細詳細詳細詳細詳細詳細詳細詳細詳細詳細詳細
                            </td>
                        </tr>
                        <tr>
                            <th>参加者</th>
                            <td>grkon</td>
                        </tr>
                        <tr>
                            <th>不参加者</th>
                            <td></td>
                        </tr>
                    </tbody>
                </table>
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