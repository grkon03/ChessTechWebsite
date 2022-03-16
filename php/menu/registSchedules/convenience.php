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
                require_once("../../template/header_template.php");
                write_header(2);
            ?>
        </header>
        <div id="main">
            <div id="menu_page_main">
                <h2><?php echo $title; ?></h2>
                <div id="view_member_convenience" class="menu_page_mini">
                    <table>
                        <tbody>
                            <tr>
                                <th>参加可能</th>
                                <td>grkon</td>
                            </tr>
                            <tr>
                                <th>予定未定</th>
                                <td>taroimo</td>
                            </tr>
                            <tr>
                                <th>参加不可</th>
                                <td></td>
                            </tr>
                        </tbody>
                    </table>
                    <?php
                        if (!$specified_correctly) {
                            echo "日付を指定してください。";
                        } else {
                            
                        }
                    ?>
                    <a id="back_to_index" href="./">
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
                require_once("../../template/footer_template.php");
                write_footer(2);
            ?>
        </footer>
    </body>
</html>