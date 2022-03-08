<?php
    session_start();
    $id = $_SESSION["id"];

    if ($id == "") {
        header("Location: ./login.php");
    }

    require_once("../../util/mysql.php");
    $sql_util = new MYSQL_UTIL();
    
    $member = $sql_util->GetMember($id);
?>
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
                    <div id="registJA_byCalendar">
                        <p>
                            カレンダーのイベントをクリックして、イベントの詳細ページで参加/不参加を入力してください。
                        </p>
                        <a href="./../../calendar/">
                            カレンダーへ移動
                        </a>
                    </div>
                </div>
                <div class="menu_page_mini">
                    <h3>イベント一覧から登録する</h3>
                    <div id="registJA_bySelect">
                        <?php
                            if (isset($_POST["id"])) {
                                $sch_id = intval($_POST["id"]);
                                $joinable = $_POST["joinable"] == "T" ? true : false;
                                $sql_util->RegistMemberSchedule($sch_id, $member->id, $joinable);
                            }

                            $schs = $sql_util->GetAllSchedules();
                            
                            foreach ($schs as $e) {
                                $joinable = false;
                                $notjoinable = false;
                                $decided = true;

                                if (in_array($member->id, explode(",", $e->members_join))) {
                                    $joinable = true;
                                } else if (in_array($member->id, explode(",", $e->members_notjoin))) {
                                    $notjoinable = true;
                                } else {
                                    $decided = false;
                                }

                                $joinable_checked = "";
                                $notjoinable_checked = "";
                                $submit_value = "";

                                if ($joinable) {
                                    $joinable_checked = " checked";
                                }

                                if ($notjoinable) {
                                    $notjoinable_checked = " checked";
                                }

                                if ($decided) {
                                    $submit_value = "変更";
                                } else {
                                    $submit_value = "登録";
                                }

                                echo <<<EOF
                        <div class="registJA_bySelect_item">
                            <h4><a href="./../../calendar/">{$e->name}</a></h4>
                            <div class="registJA_bySelect_item_form">
                                <form action="./" method="POST">
                                    <input type="hidden" name="id" value="{$e->id}">
                                    <div class="registJA_bySelect_item_form_radio">
                                        <span class="registJA_bySelect_item_form_radio_item">
                                            <input type="radio" name="joinable" value="T"{$joinable_checked}>参加する
                                        </span>
                                        <span class="registJA_bySelect_item_form_radio_item">
                                            <input type="radio" name="joinable" value="F"{$notjoinable_checked}>参加しない
                                        </span>
                                    </div>
                                    <input class="registJA_bySelect_item_form_submit" type="submit" value="{$submit_value}">
                                </form>
                            </div>
                        </div>
EOF;
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