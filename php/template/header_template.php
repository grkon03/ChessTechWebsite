<?php
    require_once(dirname(__FILE__) . "/../util/util.php");
    /* 
        $rank   : The depth of directory
            ex) calender/index.php  : $rank = 1
                index.php           : $rank = 0
     */
    function write_header ($rank) {
        
        $pl = path_linker($rank);

        $header = <<<EOF
        <div class="floatbox">
            <div id="header_title">
                <a href="{$pl}">ChessTech</a>
            </div>
            <div id="header_menu">
                <div class="header_menu_item">
                    <a href="{$pl}calender/">Calender</a>
                </div>
                <div class="header_menu_item">
                    <a href="">Activity</a>
                </div>
                <div class="header_menu_item">
                    <a href="">About</a>
                </div>
                <div class="header_menu_item">
                    <a href="{$pl}menu/">Member's Menu</a>
                </div>
            </div>
        </div>
EOF;
        echo $header;
    }
?>