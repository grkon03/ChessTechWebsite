<!DOCTYPE html>
<html lang="ja">
    <head>
        <meta charset="utf-8">
        <meta name="description" content="東工大チェスサークルChessTechの紹介ページです。サークルに関する情報はこちらから確認できます。">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link href="./css/setting.css" rel="stylesheet">
        <link href="./css/header.css" rel="stylesheet">
        <link href="./css/footer.css" rel="stylesheet">
        <link href="./css/main/about.css" rel="stylesheet">
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
            <section id="about">
                <h1>About</h1>
                <section>
                    <h2>設立</h2>
                    <p>
                        　ChessTechは、2021年6月に設立されたサークルです。このサークル設立まで、東工大にはチェスサークルが存在しておらず、
                        Twitterなどでは過去にもチェスサークルが存在しないことを嘆く呟きがいくつかありました。それを見た、
                        当時チェスの実力に伸び悩んでいた設立者(安田)が、チェスの実力向上を目的に設立しました。
                    </p>
                </section>
                <section>
                    <h2>主な活動内容</h2>
                    <p>
                        　オンラインでは少しずつチェスをプレイしなくなっていく可能性があるので、基本的には対面活動にこだわっています。
                        ただし、covid-19 が流行している時期や、帰省などで集まることが難しくなる長期休暇などでは、オンラインの活動をしています。
                    </p>
                    <p>
                        　現在の対面活動では、次のように対局を行なっています。
                        <ul>
                            <li>
                                15分+10秒戦
                            </li>
                            <li>
                                対局中は時間がある限りお互い棋譜を記録
                            </li>
                            <li>
                                対局後は出来るだけ手動で棋譜検討
                            </li>
                        </ul>
                        こう見ると一見堅苦しい感じがしますが、タイムレンジが長いので、みんなでお菓子をつまみながら指しています。
                        対局の設定は堅実にしていますが、雰囲気は緩めでやっています。
                    </p>
                    <p>
                        　上のような対局をおこなっているのは理由は、優先度順に次の目的のためです。
                        <ol>
                            <li>
                                対局後の棋譜検討で実力をつけるため(棋譜記録の理由)
                            </li>
                            <li>
                                しっかり考えて1手を指すため(長めのタイムレンジ)
                            </li>
                            <li>
                                活動時間をおおよそ2時間として2局を指すため(30分戦でない理由)
                            </li>
                        </ol>
                    </p>
                </section>
                <section id="for_join">
                    <h2>入部を考えている方へ</h2>
                    <p>
                        　次の情報を参考にしてください。
                    </p>
                    <table>
                        <tbody>
                            <tr>
                                <th>
                                    活動場所
                                </th>
                                <td>
                                    石川町文化センター和室
                                </td>
                            </tr>
                            <tr>
                                <th>
                                    部費
                                </th>
                                <td>
                                    現在は無し*
                                </td>
                            </tr>
                            <tr>
                                <th>
                                    連絡方法
                                </th>
                                <td>
                                    Discord・LINE
                                </td>
                            </tr>
                            <tr>
                                <th>部員数</th>
                                <td>
                                    <?php
                                        require_once("./util/mysql.php");
                                        $sql_util = new MYSQL_UTIL();
                                        echo count($sql_util->GetAllMembers()) . "人";
                                    ?>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                    <p>
                        *部費についてですが、次の条件のいずれかが満たされた時に6ヶ月2000円で回収を開始します。(部員数によっては安くなるかもしれないです。)
                        <ul>
                            <li>
                                部員が20人に達する
                            </li>
                            <li>
                                2023年4月に達する
                            </li>
                            <li>
                                現代表(安田)のお財布が限界に達する
                            </li>
                        </ul>
                        <small>(裏話ですが、現在は入部しやすいように部費を回収せず設立者である安田が負担しています。)</small><br />
                        入部方法ついてですが、トップページやTwitterにも載せてある通り<a href="https://lichess.org/team/0hFIsUIf">lichessのチーム</a>
                        に参加してください。
                    </p>
                </section>
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