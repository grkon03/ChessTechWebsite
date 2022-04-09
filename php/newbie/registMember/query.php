<?php
    session_start();
    require_once(dirname(__FILE__) . "/../../util/mysql.php");
    
    $sql_util = new MYSQL_UTIL();
?>
<!DOCTYPE html>
<html lang="ja">
    <head>
        <meta charset="utf-8">
        <meta name="description" content="東工大チェスサークルChessTechのサークルメンバー登録ページです。サークル外部の方はアクセスしないでください。">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link href="./../../css/setting.css" rel="stylesheet">
        <link href="./../../css/header.css" rel="stylesheet">
        <link href="./../../css/footer.css" rel="stylesheet">
        <link href="./../../css/main/newbie/registMember/query.css" rel="stylesheet">
        <script>console.log("prevent Google Chrome css Transition");</script>
        <title>東工大チェスサークル ChessTech</title>
    </head>
    <body>
        <header>
            <?php
                require_once(dirname(__FILE__) . "/./../../template/header_template.php");
                write_header(2);
            ?>
        </header>
        <div id="main">
            <div id="regist_member_query">
                <?php
                    if (isset($_POST["ct_code"])) {
                        $id = htmlspecialchars($_POST["ct_id"], ENT_QUOTES, 'UTF-8');
                        $password = htmlspecialchars($_POST["ct_password"], ENT_QUOTES, 'UTF-8');
                        $name = htmlspecialchars($_POST["ct_name"], ENT_QUOTES, 'UTF-8');
                        $handle_name = htmlspecialchars($_POST["ct_handle_name"], ENT_QUOTES, 'UTF-8');
                        $grade = htmlspecialchars($_POST["ct_grade"], ENT_QUOTES, 'UTF-8');
                        $code = htmlspecialchars($_POST["ct_code"], ENT_QUOTES, 'UTF-8');

                        $authority = 0;

                        $cor_code = file("./data/code");

                        //注意：招待コードは8文字
                        for ($i = 0; $i < count($cor_code); $i++) {
                            if (substr($cor_code[$i], 0, 8) == $code) {
                                $authority = $i + 1;
                            }
                        }

                        $err_mes = null;

                        if ($authority == 0) {
                            $err_mes = "招待コードが間違っています。";
                            file_put_contents("./data/wrongcode.log", $_SERVER["REMOTE_ADDR"] . "\n",  FILE_APPEND);
                        } else if ($sql_util->GetMember($id) == null) {
                            $err_mes = "すでに使用されているidです。";
                        } else {
                            echo <<<EOF
                        <div id="regist_member_query_verify">
                            <table>
                                <tbody>
                                    <tr>
                                        <th>ID</th>
                                        <td>{$id}</td>
                                    </tr>
                                    <tr>
                                        <th>Password</th>
                                        <td>{$password}</td>
                                    </tr>
                                    <tr>
                                        <th>名前</th>
                                        <td>{$name}</td>
                                    </tr>
                                    <tr>
                                        <th>ハンドルネーム</th>
                                        <td>{$handle_name}</td>
                                    </tr>
                                    <tr>
                                        <th>学年</th>
                                        <td>{$grade}</td>
                                    </tr>
                                </tbody>
                            </table>
                            <form action="./query.php" class="regist_member_query_button_form" method="POST">
                                <input type="hidden" name="ct_id" value="{$id}">
                                <input type="hidden" name="ct_password" value="{$password}">
                                <input type="hidden" name="ct_name" value="{$name}">
                                <input type="hidden" name="ct_handle_name" value="{$handle_name}">
                                <input type="hidden" name="ct_grade" value="{$grade}">
                                <input type="hidden" name="ct_authority" value="{$authority}">
                                <input type="submit" id="regist_member_query_submit" class="regist_member_query_button" value="登録">
                            </form>
                            <form action="./index.php" class="regist_member_query_button_form" method="POST">
                                <input type="hidden" name="ct_id" value="{$id}">
                                <input type="hidden" name="ct_password" value="{$password}">
                                <input type="hidden" name="ct_name" value="{$name}">
                                <input type="hidden" name="ct_handle_name" value="{$handle_name}">
                                <input type="hidden" name="ct_grade" value="{$grade}">
                                <input type="hidden" name="ct_code" value="{$code}">
                                <input type="submit" id="regist_member_query_fix" class="regist_member_query_button" value="修正">
                            </form>
                        </div>
EOF;
                        }
                    } else if (isset($_POST["ct_authority"])) {
                        $mem = new Member();
                        $mem->id = $_POST["ct_id"];
                        $mem->pass = $_POST["ct_password"];
                        $mem->name = $_POST["ct_name"];
                        $mem->handle_name = $_POST["ct_handle_name"];
                        $mem->grade = $_POST["ct_grade"];
                        $mem->authority = $_POST["ct_authority"];
                        $mem->position = "";
                        $mem->joinable_dayofweek = 0;
                        $sql_util->CreateMember($mem);
                        $_SESSION["id"] = $mem->id;
                        echo "登録が完了しました。";
                    } else {
                        echo <<<EOF
                            不正アクセスです。
EOF;
                    }

                    if ($err_mes != null) {
                        echo <<<EOF
                        {$err_mes}<br />
                        <form action="./index.php" class="regist_member_query_button_form" method="POST">
                            <input type="hidden" name="ct_id" value="{$id}">
                            <input type="hidden" name="ct_password" value="{$password}">
                            <input type="hidden" name="ct_name" value="{$name}">
                            <input type="hidden" name="ct_handle_name" value="{$handle_name}">
                            <input type="hidden" name="ct_grade" value="{$grade}">
                            <input type="hidden" name="ct_code" value="{$code}">
                            <input type="submit" id="regist_member_query_fix" class="regist_member_query_button" value="修正">
                        </form>
EOF;
                    }
                ?>
            </div>
        </div>
        <footer>
            <?php
                require_once(dirname(__FILE__) . "/./../../template/footer_template.php");
                write_footer(2);
            ?>
        </footer>
    </body>
</html>