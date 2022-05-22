<?php
    session_start();
    $id = $_SESSION["id"];

    if ($id == "") {
        header("Location: ./../login.php");
    }

    require_once(dirname(__FILE__) . "/../../util/mysql.php");
    $sql_util = new MYSQL_UTIL();
    
    $member = $sql_util->GetMember($id);

    if ($member->authority > 2) {
        header("Location: ./../index.php");
    }
?>
<!DOCTYPE html>
<html lang="ja">
    <head>
        <meta charset="utf-8">
        <meta name="description" content="東工大チェスサークルChessTechの部内メニューです。ここではプロフィールを編集できます。">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link href="./../../css/setting.css" rel="stylesheet">
        <link href="./../../css/header.css" rel="stylesheet">
        <link href="./../../css/footer.css" rel="stylesheet">
        <link href="./../../css/menu.css" rel="stylesheet">
        <link href="./../../css/main/menu/changeMembersProfile/changeMPF.css" rel="stylesheet">
        <script>console.log("prevent Google Chrome css Transition");</script>
        <title>プロフィールを変更する | 東工大チェスサークル ChessTech</title>
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
                <?php
                    $m = $sql_util->GetMember($_GET["id"]);
                    if (isset($_POST["editMPF"])) {
                        $m->pass = $_POST["pass"];
                        $m->name = $_POST["name"];
                        $m->handle_name = $_POST["handle_name"];
                        $m->grade = $_POST["grade"];
                        $m->authority = $_POST["authority"];
                        $m->position = $_POST["position"];
                        $sql_util->UpdateMember($member);
                    }
                ?>
                <h2>プロフィールを変更する</h2>
                <div id="editMPF">
                    <div id="editMPF_formarea">
                        <form action="./changeMPF.php?id=<?php echo $m->id; ?>" method="POST">
                            <table>
                                <tbody>
                                    <tr>
                                        <th>ID</th>
                                        <td>
                                            <input name="ID" value="<?php echo $m->id; ?>" class="readonly input_text" readonly>
                                        </td>
                                    </tr>
                                    <tr>
                                        <th>PassWord</th>
                                        <td>
                                            <input name="pass" value="<?php echo $m->pass; ?>" class="readonly input_text" readonly>
                                        </td>
                                    </tr>
                                    <tr>
                                        <th>名前</th>
                                        <td>
                                            <input name="name" value="<?php echo $m->name; ?>" class="input_text" required>
                                        </td>
                                    </tr>
                                    <tr>
                                        <th>ハンドルネーム</th>
                                        <td>
                                            <input name="handle_name" value="<?php echo $m->handle_name; ?>" class="readonly input_text" readonly>
                                        </td>
                                    </tr>
                                    <tr>
                                        <th>学年</th>
                                        <td>
                                            <input name="grade" value="<?php echo $m->grade; ?>" class="input_text" required>
                                        </td>
                                    </tr>
                                    <tr>
                                        <th>権限ランク</th>
                                        <td>
                                            <input name="authority" type="number" value="<?php echo $m->authority; ?>" class="input_text" required>
                                        </td>
                                    </tr>
                                    <tr>
                                        <th>役職</th>
                                        <td>
                                            <input name="position" value="<?php echo $m->position; ?>" class="input_text" required>
                                        </td>
                                    </tr>
                                    <input type="hidden" name="editMPF" value="">
                                    <tr>
                                        <th id="submit_th"></th>
                                        <td>
                                            <input type="submit" value="変更する" id="editMPF_submit">
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </form>
                    </div>
                    <div id="editMPF_caution">
                        <h4>注意事項</h4>
                        <ul>
                            <li>
                                灰色のフォームは変更不可能な内容です。入力できません。
                            </li>
                        </ul>
                    </div>
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