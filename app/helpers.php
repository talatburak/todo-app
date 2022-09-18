<?php 

if(!function_exists("convertDateToReadable")) {
    function convertDateToReadable($date) {
        $splitDate = explode(" ", $date);
        if(count($splitDate) > 1) {
            return implode(".", array_reverse(explode("-", $splitDate[0])))." ".$splitDate[1];
        } else {
            return implode(".", array_reverse(explode("-", $date)));
        }
    }
}

?>