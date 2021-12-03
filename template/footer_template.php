<?php
    function write_footer() {
        $footer = <<<EOF
        <div class="floatbox">
            <div id="footer_link">
                <span id="footer_link_title">Links</span>
                <div class="footer_link_item">
                    <a href="calender.php">Calender</a>
                </div>
                <div class="footer_link_item">
                    <a href="calender.php">Privacy Policy</a>
                </div>
            </div>
            <div id="footer_copyright">
                (c)2021 ChessTech
            </div>
        </div> 
EOF;
        echo $footer;
    }
?>