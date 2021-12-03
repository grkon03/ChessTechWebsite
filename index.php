<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link href="./css/setting.css" rel="stylesheet">
        <link href="./css/header.css" rel="stylesheet">
        <link href="./css/footer.css" rel="stylesheet">
        <script>console.log("prevent Google Chrome css Transition");</script>
        <title>東工大チェスサークル ChessTech</title>
    </head>
    <body>
        <header>
            <?php
                require("./template/header_template.php");
                write_header();
            ?>
        </header>
        <div id="main">

        </div>
        <footer>
            <?php
                require("./template/footer_template.php");
                write_footer();
            ?>
        </footer>
    </body>
</html>