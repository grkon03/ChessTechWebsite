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
        <link href="./../../css/main/menu/registJoinableDays/index.css" rel="stylesheet">
        <script>console.log("prevent Google Chrome css Transition");</script>
        <title>活動可能日を登録する | 東工大チェスサークル ChessTech</title>
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
                <h2>活動可能日を登録する</h2>
                <div class="menu_page_mini">
                    <?php
                        $jd_sun = false;
                        $jd_mon = false;
                        $jd_tue = false;
                        $jd_wed = false;
                        $jd_thi = false;
                        $jd_fri = false;
                        $jd_sat = false;

                        if (isset($_POST["weekform"])) {
                            $jd_sun = isset($_POST["jd_sun"]);
                            $jd_mon = isset($_POST["jd_mon"]);
                            $jd_tue = isset($_POST["jd_tue"]);
                            $jd_wed = isset($_POST["jd_wed"]);
                            $jd_thi = isset($_POST["jd_thi"]);
                            $jd_fri = isset($_POST["jd_fri"]);
                            $jd_sat = isset($_POST["jd_sat"]);
                            
                            $joinable_dayofweek = 0;
                            if ($jd_sun)
                                $joinable_dayofweek += 1;
                            if ($jd_mon)
                                $joinable_dayofweek += 2;
                            if ($jd_tue)
                                $joinable_dayofweek += 4;
                            if ($jd_wed)
                                $joinable_dayofweek += 8;
                            if ($jd_thi)
                                $joinable_dayofweek += 16;
                            if ($jd_fri)
                                $joinable_dayofweek += 32;
                            if ($jd_sat)
                                $joinable_dayofweek += 64;
                            
                            $new_mem = new Member();
                            $new_mem->id = $member->id;
                            $new_mem->joinable_dayofweek = $joinable_dayofweek;

                            $sql_util->UpdateMember($new_mem);
                        } else {
                            if ($member->joinable_dayofweek === null) {
                                $new_mem = new Member();
                                $new_mem->id = $member->id;
                                $new_mem->joinable_dayofweek = 0;
    
                                $sql_util->UpdateMember($new_mem);

                                $member->joinable_dayofweek = 0;
                            }

                            $jd_week = $member->joinable_dayofweek;

                            if (($jd_week & 1) != 0)
                                $jd_sun = true;
                            if (($jd_week & 2) != 0) 
                                $jd_mon = true;
                            if (($jd_week & 4) != 0)
                                $jd_tue = true;
                            if (($jd_week & 8) != 0)
                                $jd_wed = true;
                            if (($jd_week & 16) != 0)
                                $jd_thi = true;
                            if (($jd_week & 32) != 0)
                                $jd_fri = true;
                            if (($jd_week & 64) != 0)
                                $jd_sat = true;
                        }
                    ?>
                    <h3>曜日ごとに決める</h3>
                    <p>
                        活動可能な曜日を決定してください。こちらの入力を優先してください。
                    </p>
                    <div id="registJD_weekform">
                        <form action="./" method="POST">
                            <table>
                                <tbody>
                                    <tr>
                                        <td>
                                            <input type="checkbox" class="registJD_checkbox" value="参加する" name="jd_sun" value=""
                                                <?php if ($jd_sun) { echo " checked"; } ?>
                                            >
                                        </td>
                                        <th>日曜日</th>
                                    </tr>
                                    <tr>
                                        <td>
                                            <input type="checkbox" class="registJD_checkbox" value="参加する" name="jd_mon" value=""
                                                <?php if ($jd_mon) { echo " checked"; } ?>
                                            >
                                        </td>
                                        <th>月曜日</th>
                                    </tr>
                                    <tr>
                                        <td>
                                            <input type="checkbox" class="registJD_checkbox" value="参加する" name="jd_tue" value=""
                                                <?php if ($jd_tue) { echo " checked"; } ?>
                                            >
                                        </td>
                                        <th>火曜日</th>
                                    </tr>
                                    <tr>
                                        <td>
                                            <input type="checkbox" class="registJD_checkbox" value="参加する" name="jd_wed" value=""
                                                <?php if ($jd_wed) { echo " checked"; } ?>
                                            >
                                        </td>
                                        <th>水曜日</th>
                                    </tr>
                                    <tr>
                                        <td>
                                            <input type="checkbox" class="registJD_checkbox" value="参加する" name="jd_thi" value=""
                                                <?php if ($jd_thi) { echo " checked"; } ?>
                                            >
                                        </td>
                                        <th>木曜日</th>
                                    </tr>
                                    <tr>
                                        <td>
                                            <input type="checkbox" class="registJD_checkbox" value="参加する" name="jd_fri" value=""
                                                <?php if ($jd_fri) { echo " checked"; } ?>
                                            >
                                        </td>
                                        <th>金曜日</th>
                                    </tr>
                                    <tr>
                                        <td>
                                            <input type="checkbox" class="registJD_checkbox" value="参加する" name="jd_sat" value=""
                                                <?php if ($jd_sat) { echo " checked"; } ?>
                                            >
                                        </td>
                                        <th>土曜日</th>
                                    </tr>
                                </tbody>
                            </table>
                            <input type="hidden" name="weekform" value="">
                            <input type="submit" value="登録" class="registJD_submit">
                        </form>
                    </div>
                </div>
                <div class="menu_page_mini">
                    <?php
                        if (isset($_POST["eachday"])) {
                            $date = new DateTime($_POST["jd_date"]);
                            $state = intval($_POST["jd_state"]);
                            $sql_util->RegistMemberJoinableDay($date, $id, $state);
                        }
                    ?>
                    <h3>日にちごとに決める</h3>
                    <p>
                        活動可能な曜日として決めたものに対し、例外的に参加可能/参加不可となる日にちを登録してください。
                    </p>
                    <div id="registJD_eachday">
                        <form action="./" method="POST">
                            <input name="jd_date" class="registJD_eachday_input" type="date" required>
                            <select name="jd_state" class="registJD_eachday_input" required>
                                <option value="0">取り消し</option>
                                <option value="1" selected>参加可能</option>
                                <option value="2">予定未定</option>
                                <option value="3">参加不可</option>
                            </select><br />
                            <input name="eachday" value="" type="hidden">
                            <input type="submit" value="送信" class="registJD_submit">
                        </form>
                    </div>
                    <div id="displayJD_eachday">
                        <h4>
                            現在登録している日にち
                        </h4>
                        <div id="displayJD_eachday_lists">
                            <script>
                                function registJD_eachday(date, state) {
                                    let jd_date = document.getElementsByName("jd_date")[0];
                                    jd_date.value = date;
                                    
                                    let jd_state = document.getElementsByName("jd_state")[0];
                                    jd_state.selectedIndex = state;
                                    console.log(state);

                                    location.href = "#registJD_eachday";
                                }
                            </script>
                            <?php
                                $jois = $sql_util->GetJoinableDays_byID($id);
                                if ($jois != null) {
                                    foreach ($jois as $e) {
                                        $state_str = "";
                                        $state = 0;
                                        if (in_array($id, explode(",", $e->joinable))) {
                                            $state_str = "参加可能";
                                            $state = 1;
                                        } else if (in_array($id, explode(",", $e->maybe_joinable))) {
                                            $state_str = "予定未定";
                                            $state = 2;
                                        } else if (in_array($id, explode(",", $e->notjoinable))) {
                                            $state_str = "参加不可";
                                            $state = 3;
                                        } else {
                                            $state_str = "エラー";
                                            $state = 0;
                                        }
                                        
                                        echo <<<EOF
                                <div class="displayJD_eachday_item">
                                    <span class="displayJD_eachday_item_date">{$e->date->format("Y/m/d")}</span>
                                    <span class="displayJD_eachday_item_state">{$state_str}</span>
                                    <button onclick="registJD_eachday('{$e->date->format("Y-m-d")}', {$state})" class="displayJD_eachday_item_state">変更する</button>
                                </div>
EOF;
                                    }
                                }
                            ?>
                        </div>
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