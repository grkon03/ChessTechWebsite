<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta name="description" content="東工大チェスサークルChessTechの活動予定カレンダーのページです。">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link href="./../css/setting.css" rel="stylesheet">
        <link href="./../css/header.css" rel="stylesheet">
        <link href="./../css/footer.css" rel="stylesheet">
        <link href="./../css/main/contact/index.css" rel="stylesheet">
        <script>console.log("prevent Google Chrome css Transition");</script>
        <title>お問い合わせ | 東工大チェスサークル ChessTech</title>
    </head>
    <body>
        <header>
            <?php
                require_once("../template/header_template.php");
                write_header(1);
            ?>
        </header>
        <div id="main">
            <div id="contact_app">
                <h2>お問い合わせフォーム</h2>
                <div id="form_wrap">
                    <form action="send.php" method="POST">
                        <dl>
                            <dt>お名前/団体名</dt>
                            <dd><input type="text" name="name" value="<?php echo $_POST["name"]; ?>" require_onced></dd>
                            <dt>メールアドレス</dt>
                            <dd><input type="email" name="mail" value="<?php echo $_POST["mail"]; ?>" require_onced></dd>
                            <dt>件名</dt>
                            <dd><input type="text" name="title" value="<?php echo $_POST["title"]; ?>" require_onced></dd>
                            <dt>お問い合わせ内容</dt>
                            <dd><textarea name="content" require_onced><?php echo $_POST["content"]; ?></textarea></dd>
                        </dl>
                        <input type="submit" id="form_submit">
                    </form>
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