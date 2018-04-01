<?php
/**
 * Created by PhpStorm.
 * User: root
 * Date: 18-3-15
 * Time: 下午9:49
 */

require_once "get_flow.php";
function main_1_flow($in_port)
{
    $result = array(
        "result" => false,
        "reason" => null
    );
    $output_flow = get_flow();

//can't find the flow table
    if ($output_flow == null) {
        $result = array(
            "result" => false,
            "reason" => "please connect the ODL"
        );
    } else {
        if (count($output_flow["errors"])) {
            $result = array(
                "result" => false,
                "reason" => "error of flow table"
            );
        } //find the flow table
        else {
            $match_port = $output_flow["flow-node-inventory:flow"][0]["match"]["in-port"];
            $match_ip = $output_flow["flow-node-inventory:flow"][0]["match"]["ipv4-source"];
            $match_mac = $output_flow["flow-node-inventory:flow"][0]["match"]["ethernet-match"]["ethernet-source"]["address"];
            //the match is right(for the port or the ip or the mac)
            if(($match_ip == '10.0.0.1/32') || ($match_mac == '00:00:00:00:00:01') || ($match_port == $in_port)) {
                $action = $output_flow["flow-node-inventory:flow"][0]["instructions"]["instruction"][0]["apply-actions"]["action"][0];
                //the action is right
                if ($action["group-action"]["group-id"] == 1234) {
                    $result = array(
                        "result" => true,
                        "reason" => null
                    );
                }
                //the action is wrong
                else {
                    $result = array(
                        "result" => false,
                        "reason" => "error of the flow action"
                    );
                    }
            }//the match is wrong(for the port or the ip or the mac)
            else{
                $result = array(
                    "result" => false,
                    "reason" => "error of the match"
                );
            }
        }
    }
    return $result;

}
