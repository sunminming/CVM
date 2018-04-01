<?php
/**
 * Created by PhpStorm.
 * User: root
 * Date: 18-3-18
 * Time: 下午3:21
 */

require_once "main_1_flow.php";
require_once "main_1_group.php";

//for the group table
$group_result = main_1_group();

//find the group table and the table is right
if($group_result["result"] == true){
    $result = main_1_flow($group_result["in_port"]);
}
//find the group table but the table is wrong
else{
    $result = array(
        "result" => false,
        "reason" => $group_result["reason"]
    );

}

$result = json_encode($result);
echo $result;
