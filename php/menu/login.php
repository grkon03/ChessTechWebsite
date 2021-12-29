<!DOCTYPE html>
<html lang="ja">
    <head>
        <meta charset="utf-8">
        <meta name="description" content="東工大チェスサークルChessTechのホームページです。活動の記録や予定、お問い合わせはこちらからできます。">
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
                require("../template/header_template.php");
                write_header(1);
            ?>
        </header>
        <div id="main">
            <div id="login_application">
                <h2>Log in</h2>
                <div id="login_form">
                    <form action="./login.php" method="POST">
                        <table>
                            <tbody>
                                <!-- ブラウザのサジェストが邪魔にならないように ct_ をつける -->
                                <tr>
                                    <th>User ID</th>
                                    <td><input type="text" name="ct_id" class="login_form_textinput" required></td>
                                </tr>
                                <tr>
                                    <th>Password</th>
                                    <td><input type="password" name="ct_pass" class="login_form_textinput" required></td>
                                </tr>
                                <tr>
                                    <th></th>
                                    <td><input type="submit" value="Log in" id="login_form_submit"></td>
                                </tr>
                            </tbody>
                        </table>
                    </form>
                </div>
            </div>
        </div>
        <footer>
            <?php
                require("../template/footer_template.php");
                write_footer(1);
            ?>
        </footer>
    </body>
</html>