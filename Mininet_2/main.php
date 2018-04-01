<?php
/**
 * Created by PhpStorm.
 * User: root
 * Date: 18-3-23
 * Time: 上午9:42
 */

require_once "open_reply.php";
require_once "open_request.php";

$reason = null;
if(!reply()){
    $reason = $reason.("can't find icmp reply ");
}

if(!request()){
    $reason = $reason.("can't find icmp request ");
}

$output = array(
    "result" => reply() && request(),
    "reason" => $reason
);

$output = json_encode($output);
echo $output;