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
                require_once("./../../template/header_template.php");
                write_header(2);
            ?>
        </header>
        <div id="main">
            <div id="regist_member_query">
                <?php
                    if (!isset($_POST["ct_code"])) {
                        echo <<<EOF
                            不正アクセスです。
EOF;
                    } else if ($_POST["ct_decided"]) {

                    } else {
                        
                    }
                ?>
                <div id="regist_member_query_verify">
                    <table>
                        <tbody>
                            <tr>
                                <th>ID</th>
                                <td>newID</td>
                            </tr>
                            <tr>
                                <th>Password</th>
                                <td>newPassWord</td>
                            </tr>
                            <tr>
                                <th>名前</th>
                                <td>new名前</td>
                            </tr>
                            <tr>
                                <th>ハンドルネーム</th>
                                <td>newハンドルネーム</td>
                            </tr>
                            <tr>
                                <th>学年</th>
                                <td>new学年</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <footer>
            <?php
                require_once("./../../template/footer_template.php");
                write_footer(2);
            ?>
        </footer>
    </body>
</html>