<?php
    session_start();
?>
<!DOCTYPE html>
<html lang="ja">
    <head>
        <meta charset="utf-8">
        <meta name="description" content="東工大チェスサークルChessTechの部内メニューを利用するためのログインページです。部員はこちらからログインしてください。">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link href="./../css/setting.css" rel="stylesheet">
        <link href="./../css/header.css" rel="stylesheet">
        <link href="./../css/footer.css" rel="stylesheet">
        <link href="./../css/main/menu/login.css" rel="stylesheet">
        <script>console.log("prevent Google Chrome css Transition");</script>
        <title>Log in | 東工大チェスサークル ChessTech</title>
    </head>
    <body>
        <header>
            <?php
                require_once("../template/header_template.php");
                write_header(1);
            ?>
        </header>
        <div id="main">
            <div id="login_application">
                <h2>Log in</h2>
                <div id="login_form">
                    <form action="./login.php?link=<?php echo $_GET["link"]; ?>" method="POST">
                        <table>
                            <tbody>
                                <!-- ブラウザのサジェストが邪魔にならないように ct_ をつける -->
                                <tr>
                                    <th>User ID</th>
                                    <td><input type="text" name="ct_id" class="login_form_textinput" value="<?php echo $_POST["ct_id"]; ?>" require_onced></td>
                                </tr>
                                <tr>
                                    <th>Password</th>
                                    <td><input type="password" name="ct_pass" class="login_form_textinput" value="<?php echo $_POST["ct_pass"]; ?>" require_onced></td>
                                </tr>
                                <tr>
                                    <th></th>
                                    <td><input type="submit" value="Log in" id="login_form_submit"></td>
                                </tr>
                            </tbody>
                        </table>
                    </form>
                </div>
                <div id="login_error">
                    <?php
                        $err_novalue = false;
                        $err_noaccount = false;

                        $id = $_POST["ct_id"];
                        $pass = $_POST["ct_pass"];
                        if (!isset($_POST["ct_id"])) {
                            // 何もなし
                        } else if ($id == "" || $pass == "") {
                            $err_novalue = true;
                        } else {
                            require_once("../util/mysql.php");
                            $sql_util = new MYSQL_UTIL();

                            $exist = $sql_util->AuthenticateMember($id, $pass);

                            if (!$exist) {
                                $err_noaccount = true;
                            } else {
                                $_SESSION["id"] = $id;

                                // GETでアクセス元のリンクを得る、なければindexとする
                                // このときのリンクは /menu からの相対パスとする
                                $link = $_GET["link"];
                                if ($link == "") {
                                    $link = "./";
                                }

                                echo "<script>";
                                echo "location.href = '" . $link . "';";
                                echo "</script>";
                            }
                        }

                        if ($err_novalue) {
                            echo "<p>";
                            echo "不正なアクセスです!<br />";
                            echo "ログインフォームの値を埋めてからログインしてください!";
                            echo "</p>";
                        }

                        if ($err_noaccount) {
                            echo "<p>";
                            echo "ログインに失敗しました!<br />";
                            echo "IDまたはパスワードが間違っている可能性があります!<br />";
                            echo "何度もログインに失敗する場合は、部長に連絡などして、アカウントの復旧などの申請をしてください!";
                            echo "</p>";
                        }
                    ?>
                </div>
                <div id="login_caution">
                    <h4>注意事項</h4>
                    <p>
                        <ul>
                            <li>部員以外はログインできません。</li>
                            <li>部員の方でまだアカウントを登録していない方は、部長などに連絡してください。</li>
                        </ul>
                    </p>
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