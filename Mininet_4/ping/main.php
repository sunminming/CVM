<?php
/**
 * Created by PhpStorm.
 * User: root
 * Date: 18-3-25
 * Time: 下午2:36
 */

require_once "open_files.php";

$output = open_files();
$flag_request = false;
$flag_reply = false;
$reason = null;
$k = 0;
for($i = 0;$i < count($output);$i++){
    if(strpos($output[$i],"ICMP echo request")) {
        $flag_request = true;
        $k = $i;
        break;
    }
}

for($j = $k + 1;$j < count($output);$j++){
    if($flag_reply == true) break;
    if(strpos($output[$j],"ICMP echo reply")){
        for($y = $j + 1;$y < count($output);$y++){
            if($output[$y] == $output[$j]){
//                echo $output[$y];
//                echo $output[$j];
                $flag_reply = true;
                break;
            }
        }
    }
}

if(!$flag_reply) $reason = $reason."can't find the reply";
if(!$flag_request) $reason = $reason."can't find the request";

$result = array(
    "result" => $flag_request && $flag_reply,
    "reason" =>$reason
);

$result = json_encode($result);
echo $result;