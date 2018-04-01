<?php
/**
 * Created by PhpStorm.
 * User: root
 * Date: 18-3-23
 * Time: 上午9:41
 */

require_once "open_files.php";
function reply(){
    $output = open_file("reply");
    $flag_request = false;
    $flag_reply = false;
    for($i = 0;$i < count($output);$i++) {
        if(!strpos($output[$i], "ICMP echo request")) $flag_request = true;
        if(strpos($output[$i], "ICMP echo reply")) $flag_reply = true;
    }

    return $flag_reply && $flag_request;
}

var_dump(reply());