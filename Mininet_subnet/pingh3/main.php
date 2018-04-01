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
for($i = 0;$i < count($output);$i++){
    if(strpos($output[$i],"10.0.0.1 > 20.0.0.1: ICMP echo request")) $flag_request = true;
    if(strpos($output[$i],"20.0.0.1 > 10.0.0.1: ICMP echo reply")) $flag_reply = true;
    if($flag_request && $flag_reply) break;
}

if(!$flag_reply) $reason = $reason."can't find the reply";
if(!$flag_request) $reason = $reason."can't find the request";

$result = array(
    "result" => $flag_request && $flag_reply,
    "reason" =>$reason
);

$result = json_encode($result);
echo $result;