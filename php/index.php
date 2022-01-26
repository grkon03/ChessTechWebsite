<!DOCTYPE html>
<html lang="ja">
    <head>
        <meta charset="utf-8">
        <meta name="description" content="東工大チェスサークルChessTechのホームページです。活動の記録や予定、お問い合わせはこちらからできます。">
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
            <section>
            <h1>東工大チェスサークル ChessTech</h1>
            <p>
                2021年6月に設立された、東工大の非公認チェスサークルです。
            </p>
            <p>
                参加したいという方は、<strong>lichessのチーム</strong>からの参加をよろしくお願いします。
                ご連絡のある方は、<strong>Twitter</strong>のダイレクトメッセージか、<strong>お問い合わせフォーム</strong>からよろしくお願いします。
            </p>
            <div class="main_link_set">
                <a class="main_link_item" href="https://lichess.org/team/0hFIsUIf">
                    lichess のチーム
                </a>
                <a class="main_link_item" href="https://twitter.com/tokyotechchess">
                    Twitter
                </a>
                <a class="main_link_item" href="./contact/">
                    お問い合わせフォーム
                </a>
            </div>
            <p>
                活動予定, 記録などはこちらです。上のメニューの<strong>Calender</strong>, <strong>Activity</strong>からも閲覧できます。
            </p>
            <div class="main_link_set">
                <a class="main_link_item" href="./calender/">
                    活動予定(カレンダー)
                </a>
                <a class="main_link_item">
                    活動記録
                </a>
            </div>
            </section>
        </div>
        <footer>
            <?php
                require_once("./template/footer_template.php");
                write_footer(0);
            ?>
        </footer>
    </body>
</html>