<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta name="description" content="東工大チェスサークルChessTechのコンタクトクエリ送信ページです。">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link href="./../css/setting.css" rel="stylesheet">
        <link href="./../css/header.css" rel="stylesheet">
        <link href="./../css/footer.css" rel="stylesheet">
        <link href="./../css/main/contact/send.css" rel="stylesheet">
        <script>console.log("prevent Google Chrome css Transition");</script>
        <title>メール送信 | 東工大チェスサークル ChessTech</title>
    </head>
    <body>
        <header>
            <?php
                require_once(dirname(__FILE__) . "/../template/header_template.php");
                write_header(1);
            ?>
        </header>
        <div id="main">
            <section id="complete_send">
                <?php
                    $name = $_POST["name"];
                    $mail = $_POST["mail"];
                    $title = $_POST["title"];
                    $content = $_POST["content"];
                    $err = false;
                    if ($name == "" || $mail == "" || $title == "" || $content == "") {
                        $err = true;
                    }

                    // 書く
                    if ($err) {
                        echo "<h2>エラー : 不正なアクセスです!</h2>";
                        echo "<p>";
                        echo "入力忘れをしていませんか？もう一度入力してください!";
                        echo "<form action='./' method='POST'>";
                        echo "<input value='$name' type='hidden' name='name'>";
                        echo "<input value='$mail' type='hidden' name='mail'>";
                        echo "<input value='$title' type='hidden' name='title'>";
                        echo "<input value='$content' type='hidden' name='content'>";
                        echo "<input value='入力を途中から再開' type='submit'>";
                        echo "</form>";
                        echo "</p>";
                    } else {
                        require_once(dirname(__FILE__) . "/../util/sendmail.php");

                        $subject .= " - " . $name . "さんより";

                        $res = sendmail_toChesstech($mail, $subject, $content);
                        
                        if (!$res) {
                            echo "<h2>エラー : 送信に失敗しました!</h2>";
                            echo "<p>";
                            echo "システムのバグの可能性が高いエラーが出ました!<br />";
                            echo "<a href='twitter.com/tokyotechchess'>Twitter</a>のダイレクトメッセージで報告していただけると嬉しいです!早急に直します!";
                            echo "また、よろしければ以下からもう一度送信を試してみてください!";
                            echo "<form action='./' method='POST'>";
                            echo "<input value='$name' type='hidden' name='name'>";
                            echo "<input value='$mail' type='hidden' name='mail'>";
                            echo "<input value='$title' type='hidden' name='title'>";
                            echo "<input value='$content' type='hidden' name='content'>";
                            echo "<input value='入力を途中から再開' type='submit'>";
                            echo "</form>";
                            echo "</p>";
                        } else {

                            echo "<h2>送信しました!</h2>";
                            echo "<p>";
                            echo "お問い合わせありがとうございます! 管理者が確認するまで返信をお待ちください!";
                            echo "</p>";

                        }
                    }
                ?>
            </section>
        </div>
        <footer>
            <?php
                require_once(dirname(__FILE__) . "/../template/footer_template.php");
                write_footer(1);
            ?>
        </footer>
    </body>
</html>