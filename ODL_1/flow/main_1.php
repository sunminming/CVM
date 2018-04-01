<?php
/**
 * Created by PhpStorm.
 * User: root
 * Date: 18-3-18
 * Time: 下午3:21
 */

require_once "main_1_flow.php";
require_once "get_inport.php";


$result = main_1_flow(get_inport());

$result = json_encode($result);
echo $result;
