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
        <link href="./../../css/main/menu/registJoinableActivities/index.css" rel="stylesheet">
        <script>console.log("prevent Google Chrome css Transition");</script>
        <title>参加/非参加を登録する | 東工大チェスサークル ChessTech</title>
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
                <h2>参加/非参加を登録する</h2>
                <div class="menu_page_mini">
                    <h3>カレンダーから登録する</h3>
                    <div id="registJA_byCalender">
                        <p>
                            カレンダーのイベントをクリックして、イベントの詳細ページで参加/不参加を入力してください。
                        </p>
                        <a href="./../../calender/">
                            カレンダーへ移動
                        </a>
                    </div>
                </div>
                <div class="menu_page_mini">
                    <h3>イベントを選択して登録する</h3>
                    <div id="registJA_bySelect">
                        <div class="registJA_bySelect_item">
                            <h4><a href="./../../calender/">イベントタイトル</a></h4>
                            <div class="registJA_bySelect_item_form">
                                <form action="./" method="POST">
                                    <input type="hidden" name="id" value="02020202">
                                    <div class="registJA_bySelect_item_form_radio">
                                        <span class="registJA_bySelect_item_form_radio_item">
                                            <input type="radio" name="joinable" value="T" checked>参加する
                                        </span>
                                        <span class="registJA_bySelect_item_form_radio_item">
                                            <input type="radio" name="joinable" value="F">参加しない
                                        </span>
                                    </div>
                                    <input class="registJA_bySelect_item_form_submit" type="submit" value="変更">
                                </form>
                            </div>
                        </div>
                        <?php
                            if (isset($_POST["id"])) {
                                $id = $_POST["id"];
                                $joinable = $_POST["id"] == "T" ? true : false;
                            }
                        ?>
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