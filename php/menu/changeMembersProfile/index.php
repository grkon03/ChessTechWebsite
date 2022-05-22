<?php
    session_start();
    $id = $_SESSION["id"];

    if ($id == "") {
        header("Location: ./../login.php");
    }

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
        <meta name="description" content="東工大チェスサークルChessTechの部内メニューです。ここでは各メンバーのプロフィールを編集できます。">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link href="./../../css/setting.css" rel="stylesheet">
        <link href="./../../css/header.css" rel="stylesheet">
        <link href="./../../css/footer.css" rel="stylesheet">
        <link href="./../../css/menu.css" rel="stylesheet">
        <link href="./../../css/main/menu/changeMembersProfile/index.css" rel="stylesheet">
        <script>console.log("prevent Google Chrome css Transition");</script>
        <title>メンバーのプロフィールを変更する | 東工大チェスサークル ChessTech</title>
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
                <h2>メンバーのプロフィールを変更する</h2>
                <div class="menu_page_mini" id="changeMPF">
                    <h3>メンバーのプロフィールを直接変更する</h3>
                    <p>
                        プロフィールを変更するメンバーを指定してください。
                    </p>
                    <div id="changeMPF_selectMember">
                        <?php
                            $members = $sql_util->GetAllMembersExceptAdmin();
                            foreach ($members as $m) {
                                echo<<<EOF
                                <a class="changeMPF_selectMember_item" href="./changeMPF.php?id={$m->id}">
                                    <span class="changeMPF_selectMember_item_id">
                                        {$m->id}
                                    </span>
                                    <span class="changeMPF_selectMember_item_name">
                                        {$m->name}
                                    </span>/<span class="changeMPF_selectMember_item_handle_name">
                                        {$m->handle_name}
                                    </span>
                                </a>
EOF;
                            }
                        ?>
                    </div>
                </div>
                <div class="menu_page_mini" id="changeAuthority">
                    <h3>メンバーの権限ランクを変更する</h3>
                    <p>
                        権限ランクkがm以上のメンバーの権限ランクをk+1に変更します。
                    </p>
                    <?php
                        if (isset($_POST["lessthan"])) {
                            $m = intval($_POST["lessthan"]);
                            $members = $sql_util->GetAllMembers();
                            foreach ($members as $mem) {
                                if (intval($mem->authority) >= $m) {
                                    $mem->authority += 1;
                                    $sql_util->UpdateMember($mem);
                                }
                            }
                            echo "<p style='color: red'>正常に完了しました。</p>";
                        }
                    ?>
                    <form action="./" method="POST" id="changeAuthority_lessthan">
                        m = <input name="lessthan" type="number" min="1" step="1" class="changeAuthority_lessthan_text">
                        <input type="submit" id="changeAuthority_lessthan_submit" value="変更">
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