<!DOCTYPE html>
<html lang="ja">
    <head>
        <meta charset="utf-8">
        <meta name="description" content="東工大チェスサークルChessTechのホームページのプライバシーポリシーです。">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link href="./css/setting.css" rel="stylesheet">
        <link href="./css/header.css" rel="stylesheet">
        <link href="./css/footer.css" rel="stylesheet">
        <link href="./css/main/privacypolicy.css" rel="stylesheet">
        <script>console.log("prevent Google Chrome css Transition");</script>
        <title>Privacy Policy | 東工大チェスサークル ChessTech</title>
    </head>
    <body>
        <header>
            <?php
                require_once(dirname(__FILE__) . "/./template/header_template.php");
                write_header(0);
            ?>
        </header>
        <div id="main">
            <section id="privacypolicy">
                <h1>プライバシーポリシー</h1>
                <section>
                    <h2>個人情報について</h2>
                    <p>
                        本サイトでは、お問い合わせやサークルメンバー情報の登録でメールアドレスやお名前等をご入力いただく場合がございます。
                        本サイトのプライバシーポリシーでは、これらの個人が特定できるような情報を個人情報とします。
                    </p>
                </section>
                <section>
                    <h2>個人情報の管理</h2>
                    <p>
                        本サイト経由でお預かりした個人情報は、不正アクセス、紛失、漏えい等が起こらないよう、慎重かつ適切に管理します。
                    </p>
                </section>
                <section>
                    <h2>個人情報の利用目的</h2>
                    <p>
                        当サイトのお問い合わせやサービスへのお申し込み等を通じて、お預かりした個人情報は、
                        以下に示す利用目的のために、適正に利用するものと致します。
                    </p>
                    <ul>
                        <li>
                            お問い合わせいただいた個人、団体の把握
                        </li>
                        <li>
                            お問い合わせメールへの返信
                        </li>
                        <li>
                            サークルメンバーの同士の管理
                        </li>
                    </ul>
                </section>
                <section>
                    <h2>個人情報の第三者提供</h2>
                    <p>
                        お預かりした個人情報は、個人情報保護法その他の法令に基づき開示が認められる場合を除き、
                        ご本人様の同意を得ずに第三者に提供することはありません。
                    </p>
                </section>
                <section>
                    <h2>アクセス解析ツールについて</h2>
                    <p>
                        当ブログでは、Googleによるアクセス解析ツール「Googleアナリティクス」を利用しています。
                        このGoogleアナリティクスはトラフィックデータの収集のためにクッキー（Cookie）を使用しております。
                        トラフィックデータは匿名で収集されており、個人を特定するものではありません。
                    </p>
                </section>
            </section>
        </div>
        <footer>
            <?php
                require_once(dirname(__FILE__) . "/./template/footer_template.php");
                write_footer(0);
            ?>
        </footer>
    </body>
</html>