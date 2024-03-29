<?php

function examination($str) {
    $count = 0;

    foreach (str_split($str) as $letter) {
        if ($letter === "(") $count += 1;
        else if ($letter === ")") $count -= 1;

        if ($count === -1) return false;
    }

    return true;
}

$string = "Hello()()";
// $arr = [1, 2, 3, 5];
 
echo "{$meters} метра(ов) это {2 + 2} футов.\n";

// echo var_export(examination($string));

// print_r(str_split($string));

// print_r(str_split($string));

