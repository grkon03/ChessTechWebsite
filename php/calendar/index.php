<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta name="description" content="東工大チェスサークルChessTechの活動予定カレンダーのページです。イベントの詳細ページへアクセスできます。">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link href="./../css/setting.css" rel="stylesheet">
        <link href="./../css/header.css" rel="stylesheet">
        <link href="./../css/footer.css" rel="stylesheet">
        <link href="./../css/main/calendar/index.css" rel="stylesheet">
        <script>console.log("prevent Google Chrome css Transition");</script>
        <title>Calendar | 東工大チェスサークル ChessTech</title>
    </head>
    <body>
        <header>
            <?php
                require_once(dirname(__FILE__) . "/../template/header_template.php");
                write_header(1);
            ?>
        </header>
        <div id="main">
            <div id="calendar_wrap">
                <?php
                    $now = new DateTime("now");

                    $month = $_GET["month"];
                    if ($month == "") {
                        $month = $now->format("m");
                    }
                    $month = intval($month);

                    $year = $_GET["year"];
                    if ($year == "") {
                        $year = $now->format("Y");
                    }
                    $year = intval($year);

                    $former_month = $month - 1;
                    $latter_month = $month + 1;
                    $former_month_year = $year;
                    $latter_month_year = $year;
                    if ($former_month == 0) {
                        $former_month = 12;
                        $former_month_year--;
                    }
                    if ($latter_month == 13) {
                        $latter_month = 1;
                        $latter_month_year++;
                    }
                ?>
                <h1>活動予定カレンダー</h1>
                <div id="calendar_month">
                    <a id="calendar_month_back" href="./?<?php echo "month=" . $former_month . "&year=" . $former_month_year; ?>">前の月</a>
                    <span id="calendar_month_now">
                        <?php
                            echo $year . "年" . $month . "月";
                        ?>
                    </span>
                    <a id="calendar_month_next" href="./?<?php echo "month=" . $latter_month . "&year=" . $latter_month_year; ?>">次の月</a>
                </div>
                <div id="calendar_application">
                    <table border="7" id="calendar_table">
                        <thead>
                            <tr>
                                <th bgcolor="#d76342">日</th>
                                <th bgcolor="#abacbc">月</th>
                                <th bgcolor="#ef6445">火</th>
                                <th bgcolor="#5478ef">水</th>
                                <th bgcolor="#aaca78">木</th>
                                <th bgcolor="#e1ca33">金</th>
                                <th bgcolor="#e1ac63">土</th>
                            </tr>
                        </thead>
                        <!--
                            例：
                                <td>
                                    <div>
                                        <div class="calendar_date">1</div>
                                        <a class="calendar_activity_item">テストテストテスト</a>
                                    </div>
                                </td>
                                <td>
                                    <div>
                                        <div class="calendar_date">1</div>
                                        <a class="calendar_activity_item">テストテストテスト</a>
                                    </div>
                                </td>
                        -->
                        <tbody>
                            <?php
                                $first_day = new DateTime($year . "-" . sprintf("%02d", $month) . "-" . "01");
                                $last_day = new DateTime("last day of " . $year . "-" . sprintf("%02d", $month));

                                require_once(dirname(__FILE__) . "/../util/mysql.php");
                                $sql_util = new MYSQL_UTIL();

                                $week_day = intval($first_day->format("w"));
                                $week_day = ($week_day + 6) % 7;
                                $first_week = true;
                                $last_week = false;
                                $day = $first_day;
                                while (true) {
                                    echo "<tr>";
                                    for ($i = 0; $i < 7; $i++) {
                                        if ($first_week || $last_week) {
                                            echo "<td></td>";
                                        } else {
                                            $schedules = $sql_util->GetSchedulesBetween($day, $day);

                                            echo "<td>";
                                            echo "<div>";
                                            echo "<div class='calendar_date'>" . $day->format("d") . "</div>";
                                            if ($schedules != null) {
                                                foreach ($schedules as $sch) {
                                                    echo "<a class='calendar_activity_item' href='detail.php?id="
                                                        . $sch->id . "'>";
                                                    echo $sch->name;
                                                    echo "</a>";
                                                }
                                            }
                                            echo "</div>";
                                            echo "</td>";

                                            $day->modify("+1 days");
                                        }

                                        if ($first_week && $i == $week_day) {
                                            $first_week = false;
                                        }
                                        if (!$last_week && intval($day->format("m") != $month)) {
                                            $last_week = true;
                                        }
                                    }
                                    echo "</tr>";
                                    if ($last_week) {
                                        break;
                                    }
                                }
                            ?>
                        </tbody>
                    </table>
                </div>
                <div id="calendar_movemonth">
                    <h4>月を指定して移動</h4>
                    <div id="calendar_movemonth_form">
                        <form action="./" method="GET">
                            <input min="2000" max="3000" type="number" name="year" id="calendar_movemonth_form_year"> 年
                            <input min="1" max="12" type="number" name="month" id="calendar_movemonth_form_month"> 月
                            <input type="submit" id="calendar_movemonth_form_submit" value="移動">
                        </form>
                    </div>
                </div>
                <div id="calendar_supplement">
                    <h4>補足</h4>
                    <ul>
                        <li>
                            活動予定をクリックすることで、詳細を見ることができます。
                        </li>
                        <li>
                            部員はログインをすることで、参加・不参加を入力することができます。
                        </li>
                        <li>
                            スマートフォンでご覧の方はスクロールができます。
                        </li>
                    </ul>
                </div>
            </div>
        </div>
        <footer>
            <?php
                require_once(dirname(__FILE__) . "/../template/footer_template.php");
                write_footer(1);
            ?>
        </footer>
    </body>
</html>