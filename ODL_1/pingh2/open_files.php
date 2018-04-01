<?php
/**
 * Created by PhpStorm.
 * User: root
 * Date: 18-3-25
 * Time: 下午2:27
 */

function open_files(){
    //translate to array
    $output = file("s4_eth2")or die("Unable to open file!");
    //easre the \n in the end of line
    for ($i = 0; $i < count($output); $i++) {
        $output[$i] = rtrim($output[$i]);
    }

    return $output;
}

//var_dump(open_files());