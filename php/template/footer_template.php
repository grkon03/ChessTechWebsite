<?php
    require_once(dirname(__FILE__) . "/../util/util.php");
    /* 
        $rank   : The depth of directory
            ex) calendar/index.php  : $rank = 1
                index.php           : $rank = 0
     */
    function write_footer($rank) {

        $pl = path_linker($rank);

        $footer = <<<EOF
        <div class="floatbox">
            <div id="footer_link">
                <span id="footer_link_title">Links</span>
                <div class="footer_link_item">
                    <a href="{$pl}calendar/">Calendar</a>
                </div>
                <div class="footer_link_item">
                    <a href="{$pl}privacypolicy.php">Privacy Policy</a>
                </div>
                <div class="footer_link_item">
                    <a href="{$pl}contact">Contact</a>
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