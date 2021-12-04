<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta name="description" content="東工大チェスサークルChessTechの活動予定カレンダーのページです。">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link href="./../css/setting.css" rel="stylesheet">
        <link href="./../css/header.css" rel="stylesheet">
        <link href="./../css/footer.css" rel="stylesheet">
        <link href="./../css/main/calender/index.css" rel="stylesheet">
        <script>console.log("prevent Google Chrome css Transition");</script>
        <title>Calender | 東工大チェスサークル ChessTech</title>
    </head>
    <body>
        <header>
            <?php
                require("../template/header_template.php");
                write_header(1);
            ?>
        </header>
        <div id="main">
            <div id="calender_wrap">
                <h1>活動予定カレンダー</h1>
                <div id="calender_application">
                    <table border="7">
                        <tbody>
                            <tr>
                                <th bgcolor="#abacbc">月</th>
                                <th bgcolor="#ef6445">火</th>
                                <th bgcolor="#5478ef">水</th>
                                <th bgcolor="#aaca78">木</th>
                                <th bgcolor="#e1ca33">金</th>
                                <th bgcolor="#e1ac63">土</th>
                                <th bgcolor="#d76342">日</th>
                            </tr>
                            <tr>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                            </tr>
                            <tr>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                            </tr>
                            <tr>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                            </tr>
                            <tr>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                            </tr>
                            <tr>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <footer>
            <?php
                require("../template/footer_template.php");
                write_footer(1);
            ?>
        </footer>
    </body>
</html>