<?php
    function path_linker($rank) {
        $pl = "./";
        for ($i = 0; $i < $rank; $i++) {
            $pl = $pl . "../";
        }
        return $pl;
    }
?>