<?php
/**
 * Created by PhpStorm.
 * User: root
 * Date: 18-3-15
 * Time: 上午10:26
 */
require_once "get_group_table.php";

function main_1_group()
{
    $result = array(
        "result" => false,
        "reason" => null,
        "in_port" => 0
    );
    $group = get_group_table();
    //don't connect the ODL
    if ($group == null) {
        $result = array(
            "result" => false,
            "reason" => "please connect the ODL"
        );
    }
    else {
    //can't find the group:1234 in openflow:1
        if (count($group["errors"])) {
            $result = array(
                "result" => false,
                "reason" => "error of group table"
            );
        }
        //find the group:1234 in openflow:1
        else {

            //echo "find the group:1234 in openflow:1" . ("\n");
            $group_type = $group["flow-node-inventory:group"][0]["group-type"];
            $group = $group["flow-node-inventory:group"][0];
            //the group table is right
            if ($group_type == "group-select") {
                //var_dump(true);
                $bucket_1_weight = $group["buckets"]["bucket"][0]["weight"];
                $bucket_2_weight = $group["buckets"]["bucket"][1]["weight"];
                $bucket_1_action = $group["buckets"]["bucket"][0]["action"][0]["output-action"]["output-node-connector"];

                $bucket_2_action = $group["buckets"]["bucket"][1]["action"][0]["output-action"]["output-node-connector"];
                //the weight is right
                if ($bucket_1_weight == 0 && $bucket_2_weight == 0) {
                    //the action is right
                    if ($bucket_2_action && $bucket_1_action) {
                        $outport = $bucket_2_action + $bucket_1_action;
                        $result["result"] = true;
                        $result["reason"] = null;
                        $result["in_port"] = 6 - $outport;
                    } //the action is wrong
                    else {
//                    $result = array(
//                        "result" => false,
//                        "reason" => "error of actions"
//                    );
                        $result["result"] = false;
                        $result["reason"] = "error of group actions";
                    }
                } //the weight is wrong
                else {
//                $result = array(
//                    "result" => false,
//                    "reason" => "error of weight"
//                );
                    $result["result"] = false;
                    $result["reason"] = "error of group weight";
                }
            } //error of type
            else {
//            $result = array(
//                "result" => false,
//                "reason" => "error of type"
//            );
                $result["result"] = false;
                $result["reason"] = "error of group type";
            }
        }
    }
    return $result;
}

$output = json_encode(main_1_group());
echo $output;
