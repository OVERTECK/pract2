<?php

$string = "2 + 3 * 4 ((((((((((((";

function Calc($string) 
{
    
    $string = str_replace(" ", "", $string);

    $arr = [];

    $SIZE = strlen($string);

    for ($i = 0; $i < $SIZE; $i++) {
        
        switch($string[$i]) {
            case "+":

        }
            

        array_push($arr, $string[$i]);
    }



    return print_r($arr);
}

echo Calc($string);