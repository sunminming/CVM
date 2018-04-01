<?php
/**
 * Created by PhpStorm.
 * User: root
 * Date: 18-3-23
 * Time: 上午9:26
 */

function open_file($file_name){
    //translate to array
    $output = file($file_name);
    //easre the \n in the end of line
    for ($i = 0; $i < count($output); $i++) {
        $output[$i] = rtrim($output[$i]);
    }
    return $output;
}
