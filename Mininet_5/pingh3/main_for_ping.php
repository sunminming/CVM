<?php
/**
 * Created by PhpStorm.
 * User: root
 * Date: 18-3-25
 * Time: 下午2:36
 */

require_once "open_s4_eth1.php";

$output = open_s2_eth1();
$flag_request = false;
$flag_reply = false;
$flag_request1 = false;
$reason = null;
for($i = 0;$i < count($output);$i++){
    if(strpos($output[$i],"ICMP echo reply")) $flag_reply = true;
    if($flag_request && $flag_reply) break;
}

if(!$flag_reply) $reason = $reason."can't find the reply";

$output = open_s1_eth1();{
    if(strpos($output[$i],"ICMP echo request")) $flag_request1 = true;
    else{
        $reason = $reason."can't find the request to 00:00:00:00:00:03";
    }
}

$result = array(
    "result" => $flag_request && $flag_reply && $flag_request1,
    "reason" =>$reason
);

$result = json_encode($result);
echo $result;