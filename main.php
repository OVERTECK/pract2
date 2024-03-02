<?php

$string = "2 + 3 * 4 ((((((((((((";

function Calc($string) 
{
    
    $string = str_replace(" ", "", $string);

    $arr_int = [];

    $SIZE = strlen($string);

    $num = "";
    for ($i = 0; $i < $SIZE; $i++) {
        
        if (is_numeric($string[$i])) {
            $num += (string)$string[$i];
        } else {
            array_push($arr_int, $string[$i]);
            $num = "";
        }
        
    }

    return print_r($arr_int);
}

echo Calc($string);