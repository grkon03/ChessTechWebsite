<!DOCTYPE html>
<html lang="ja">
    <head>
        <meta charset="utf-8">
        <meta name="description" content="東工大チェスサークルChessTechのサークルメンバー登録ページです。サークル外部の方はアクセスしないでください。">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link href="./../../css/setting.css" rel="stylesheet">
        <link href="./../../css/header.css" rel="stylesheet">
        <link href="./../../css/footer.css" rel="stylesheet">
        <link href="./../../css/main/newbie/registMember/index.css" rel="stylesheet">
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
            <div id="regist_member">
                <h1>サークルメンバー新規登録</h1>
                <div id="regist_member_form">
                    <form action="./" method="POST">
                        <table>
                            <tbody>
                                <tr>
                                    <th>ID</th>
                                    <td>
                                        <input name="ct_id" required>
                                    </td>
                                </tr>
                                <tr>
                                    <th>PassWord</th>
                                    <td>
                                        <input name="ct_password" required>
                                    </td>
                                </tr>
                                <tr>
                                    <th>名前</th>
                                    <td>
                                        <input name="ct_name" required>
                                    </td>
                                </tr>
                                <tr>
                                    <th>ハンドルネーム</th>
                                    <td>
                                        <input name="ct_handle_name" required>
                                    </td>
                                </tr>
                                <tr>
                                    <th>学年</th>
                                    <td>
                                        <input name="ct_grade" required>
                                    </td>
                                </tr>
                                <tr>
                                    <th>招待コード</th>
                                    <td>
                                        <input name="ct_code" required>
                                    </td>
                                </tr>
                                <tr>
                                    <th id="regist_member_submit_th"></th>
                                    <td>
                                        <input type="submit" id="regist_member_submit" value="登録">
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </form>
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