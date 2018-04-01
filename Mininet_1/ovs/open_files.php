<?php
/**
 * Created by PhpStorm.
 * User: root
 * Date: 18-3-23
 * Time: 下午4:12
 */

function open_file($file_name){
    //translate to array
    $output = file($file_name)or die("Unable to open file!");
    //easre the \n in the end of line
    for ($i = 0; $i < count($output); $i++) {
        $output[$i] = rtrim($output[$i]);
    }
    fclose($file_name);
    return $output;
}