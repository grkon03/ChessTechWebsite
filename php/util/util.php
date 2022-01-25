<?php
    function path_linker($rank) {
        $pl = "./";
        for ($i = 0; $i < $rank; $i++) {
            $pl = $pl . "../";
        }
        return $pl;
    }

    // 配列をカンマで区切られた文字列に変形
    function arrayToString(array $arr) {
        $str = "";
        $comma = false;
        $arr = array_diff($arr, ["", null]);
        foreach ($arr as $e) {
            if ($comma) {
                $str .= ",";
            } else {
                $comma = true;
            }
            $str .= $e;
        }

        return $str;
    }
?>