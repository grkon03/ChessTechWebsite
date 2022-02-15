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
        <link href="./../../css/main/menu/changeProfile/index.css" rel="stylesheet">
        <script>console.log("prevent Google Chrome css Transition");</script>
        <title>プロフィールを変更する | 東工大チェスサークル ChessTech</title>
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
                <h2>プロフィールを変更する</h2>
                <div id="editPF">
                    <div id="editPF_formarea">
                        <form action="./" method="POST">
                            <table>
                                <tbody>
                                    <tr>
                                        <th>ID</th>
                                        <td>
                                            <input name="ID" value="grkon" class="readonly input_text" readonly>
                                        </td>
                                    </tr>
                                    <tr>
                                        <th>名前</th>
                                        <td>
                                            <input name="name" value="安田桜輔" class="input_text" required>
                                        </td>
                                    </tr>
                                    <tr>
                                        <th>ハンドルネーム</th>
                                        <td>
                                            <input name="handle_name" value="grkon" class="input_text" required>
                                        </td>
                                    </tr>
                                    <tr>
                                        <th>学年</th>
                                        <td>
                                            <input name="grade" value="21B" class="input_text" required>
                                        </td>
                                    </tr>
                                    <tr>
                                        <th>権限ランク</th>
                                        <td>
                                            <input name="authority" value="1" class="input_text readonly" readonly>
                                        </td>
                                    </tr>
                                    <tr>
                                        <th>役職</th>
                                        <td>
                                            <input name="position" value="部長, 在籍中" class="input_text readonly" readonly>
                                        </td>
                                    </tr>
                                    <tr>
                                        <th id="submit_th"></th>
                                        <td>
                                            <input type="submit" value="変更する" id="editPF_submit">
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </form>
                    </div>
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