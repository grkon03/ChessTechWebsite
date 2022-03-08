<?php
    session_start();
    $id = $_SESSION["id"];

    if ($id == "") {
        header("Location: ./login.php");
    }

    require_once("../util/mysql.php");
    $sql_util = new MYSQL_UTIL();
    
    $member = $sql_util->GetMember($id);
?>
<!DOCTYPE html>
<html lang="ja">
    <head>
        <meta charset="utf-8">
        <meta name="description" content="東工大チェスサークルChessTechの部内メニューです。参加可能日、活動の参加の是非、プロフィールの編集などができます。">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link href="./../css/setting.css" rel="stylesheet">
        <link href="./../css/header.css" rel="stylesheet">
        <link href="./../css/footer.css" rel="stylesheet">
        <link href="./../css/main/menu/index.css" rel="stylesheet">
        <script>console.log("prevent Google Chrome css Transition");</script>
        <title>Member's Menu | 東工大チェスサークル ChessTech</title>
    </head>
    <body>
        <header>
            <?php
                require_once("../template/header_template.php");
                write_header(1);
            ?>
        </header>
        <div id="main">
            <div id="menu">
                <div class="floatbox">
                    <div id="menu_main">
                        <h2>Member's Menu</h2>
                        <p id="menu_welcome">
                            ようこそ<span id="menu_welcome_name"><?php echo $member->handle_name; ?></span>さん
                        </p>
                        <div id="menu_list">
                            <a class="menu_list_item" href="./registJoinableDays/">
                                活動可能日を登録する
                            </a>
                            <a class="menu_list_item" href="./registJoinableActivities/">
                                参加/非参加予定を登録する
                            </a>
                            <a class="menu_list_item" href="./changeProfile/">
                                プロフィールを変更する
                            </a>
                            <?php
                                $auth = $member->authority;

                                if ($auth <= 2) {

                                }

                                if ($auth <= 1) {
                                    echo "<a class='menu_list_item' href='./registSchedules/'>";
                                    echo "予定を作成する";
                                    echo "</a>";
                                }
                            ?>
                        </div>
                    </div>
                    <div id="menu_profile">
                        <h2>Profile</h2>
                        <div id="menu_profile_content">
                            <table>
                                <tbody>
                                    <tr>
                                        <th>ID</th>
                                        <td>
                                            <?php echo $member->id; ?>
                                        </td>
                                    </tr>
                                    <tr>
                                        <th>名前</th>
                                        <td>
                                            <?php echo $member->name; ?>
                                        </td>
                                    </tr>
                                    <tr>
                                        <th>ハンドルネーム</th>
                                        <td>
                                            <?php echo $member->handle_name; ?>
                                        </td>
                                    </tr>
                                    <tr>
                                        <th>学年</th>
                                        <td>
                                            <?php echo $member->grade; ?>
                                        </td>
                                    </tr>
                                    <tr>
                                        <th>権限ランク</th>
                                        <td>
                                            <?php echo $member->authority; ?>
                                        </td>
                                    </tr>
                                    <tr>
                                        <th>役職</th>
                                        <td>
                                            <?php echo $member->position; ?>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <div id="menu_caution">
                    <h4>注意事項</h4>
                    <ul>
                        <li>
                            メニューは、権限ランクによって変更されます。
                        </li>
                        <li>
                            権限ランクは、権限が高いほど数値が小さくなり、1が最高権限となっています。
                        </li>
                        <li>
                            権限ランクは、全体的な設定が変更された場合、権限自体が変更されていない場合でも数値が変更される場合があります。
                        </li>
                    </ul>
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