<?php
    function sendmail_toChesstech(string $from, string $title, string $content) {
        $to = "tokyotechchess@gmail.com";
        $header = "FROM:" . $from;
        mb_language("Japanese");
        mb_internal_encoding("UTF-8");
        mb_send_mail($to, $title, $content, $header);
    }
?>