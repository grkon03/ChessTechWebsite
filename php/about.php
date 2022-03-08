<!DOCTYPE html>
<html lang="ja">
    <head>
        <meta charset="utf-8">
        <meta name="description" content="東工大チェスサークルChessTechの紹介ページです。サークルに関する情報はこちらから確認できます。">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link href="./css/setting.css" rel="stylesheet">
        <link href="./css/header.css" rel="stylesheet">
        <link href="./css/footer.css" rel="stylesheet">
        <link href="./css/main/index.css" rel="stylesheet">
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
        </div>
        <footer>
            <?php
                require_once("./template/footer_template.php");
                write_footer(0);
            ?>
        </footer>
    </body>
</html>