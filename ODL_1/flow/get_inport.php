<?php
/**
 * Created by PhpStorm.
 * User: root
 * Date: 18-3-25
 * Time: 下午3:35
 */

require_once "get_group_table.php";
require_once "httpRequest.class.php";

function get_inport(){
    $group = get_group_table();
    $group = $group["flow-node-inventory:group"][0];
    $bucket_1_action = $group["buckets"]["bucket"][0]["action"][0]["output-action"]["output-node-connector"];
    $bucket_2_action = $group["buckets"]["bucket"][1]["action"][0]["output-action"]["output-node-connector"];
    $outport = $bucket_2_action + $bucket_1_action;
    return 6 - $outport;
}