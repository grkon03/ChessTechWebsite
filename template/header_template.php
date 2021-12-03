<?php
    function write_header () {
        $header = <<<EOF
        <div class="floatbox">
            <div id="header_title">
                ChessTech
            </div>
            <div id="header_menu">
                <div class="header_menu_item">
                    <a href="./calender.php">Calender</a>
                </div>
                <div class="header_menu_item">
                    <a href="">Log in</a>
                </div>
            </div>
        </div>
EOF;
        echo $header;
    }
?>