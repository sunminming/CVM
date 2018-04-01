<?php
/**
 * Created by PhpStorm.
 * User: root
 * Date: 18-3-23
 * Time: 下午4:34
 */

require_once "open_vlan100.php";
require_once "open_vlan200.php";

$reason = null;
if(!vlan100()){
    $reason = $reason."can't find vlan_id=100 ";
}
if(!vlan200()){
    $reason = $reason."can't find vlan_id=200 ";
}

$output = array(
    "result" => vlan100() && vlan200(),
    "reason" => $reason
);

$output = json_encode($output);
echo $output;