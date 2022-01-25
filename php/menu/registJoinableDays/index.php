<?php
    session_start();
    $id = $_SESSION["id"];

    if ($id == "") {
        header("Location: ./login.php");
    }

    require("../../util/mysql.php");
    $sql_util = new MYSQL_UTIL();
    
    $member = $sql_util->GetMember($id);
?>
<!DOCTYPE html>
<html lang="ja">
    <head>
        <meta charset="utf-8">
        <meta name="description" content="東工大チェスサークルChessTechのホームページです。活動の記録や予定、お問い合わせはこちらからできます。">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link href="./../../css/setting.css" rel="stylesheet">
        <link href="./../../css/header.css" rel="stylesheet">
        <link href="./../../css/footer.css" rel="stylesheet">
        <link href="./../../css/menu.css" rel="stylesheet">
        <link href="./../../css/main/menu/registJoinableDays/index.css" rel="stylesheet">
        <script>console.log("prevent Google Chrome css Transition");</script>
        <title>活動可能日を登録する | 東工大チェスサークル ChessTech</title>
    </head>
    <body>
        <header>
            <?php
                require("../../template/header_template.php");
                write_header(2);
            ?>
        </header>
        <div id="main">
            <div id="menu_page_main">
                <h2>活動可能日を登録する</h2>
                <div class="menu_page_mini">
                    <h3>曜日ごとに決める</h3>
                    <p>
                        活動可能な曜日を決定してください。
                    </p>
                    <div id="registAD_weekform">
                        <form action="./" method="POST">
                            <table>
                                <tbody>
                                    <tr>
                                        <td><input type="checkbox" class="registAD_checkbox" value="参加する" name="ad_sun"></td>
                                        <th>日曜日</th>
                                    </tr>
                                    <tr>
                                        <td><input type="checkbox" class="registAD_checkbox" value="参加する" name="ad_mon"></td>
                                        <th>月曜日</th>
                                    </tr>
                                    <tr>
                                        <td><input type="checkbox" class="registAD_checkbox" value="参加する" name="ad_tue"></td>
                                        <th>火曜日</th>
                                    </tr>
                                    <tr>
                                        <td><input type="checkbox" class="registAD_checkbox" value="参加する" name="ad_wed"></td>
                                        <th>水曜日</th>
                                    </tr>
                                    <tr>
                                        <td><input type="checkbox" class="registAD_checkbox" value="参加する" name="ad_thi"></td>
                                        <th>木曜日</th>
                                    </tr>
                                    <tr>
                                        <td><input type="checkbox" class="registAD_checkbox" value="参加する" name="ad_fri"></td>
                                        <th>金曜日</th>
                                    </tr>
                                    <tr>
                                        <td><input type="checkbox" class="registAD_checkbox" value="参加する" name="ad_sat"></td>
                                        <th>土曜日</th>
                                    </tr>
                                </tbody>
                            </table>
                            <input type="hidden" value="weekform" value="true">
                            <input type="submit" value="登録" id="registAD_weekform_submit">
                        </form>
                    </div>
                </div>
                <div class="menu_page_mini">
                    <h3>日にちごとに決める</h3>
                </div>
            </div>
        </div>
        <footer>
            <?php
                require("../../template/footer_template.php");
                write_footer(2);
            ?>
        </footer>
    </body>
</html>