<!DOCTYPE html>
<html lang="ja">
    <head>
        <meta charset="utf-8">
        <meta name="description" content="東工大チェスサークルのホームページです。このページは準備中か存在しないページです。">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link href="./css/setting.css" rel="stylesheet">
        <link href="./css/header.css" rel="stylesheet">
        <link href="./css/footer.css" rel="stylesheet">
        <link href="./css/main/404.css" rel="stylesheet">
        <script>console.log("prevent Google Chrome css Transition");</script>
        <title>東工大チェスサークル ChessTech</title>
    </head>
    <body>
        <header>
            <?php
                require_once("./template/header_template.php");
                write_header(0);
            ?>
        </header>
        <div id="main">
            <h1>
                404 Not Found
            </h1>
            <img src="./images/404.png">
            <div id="message404">
                <p>
                    鉄壁の黒ポーンに遮られて、見つけられなかったようです...
                </p>
                <p>
                    準備中か存在しないページの可能性が高いです
                </p>
            </div>
        </div>
        <footer>
            <?php
                require_once("./template/footer_template.php");
                write_footer(0);
            ?>
        </footer>
    </body>
</html>