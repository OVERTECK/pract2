<?php

$priorityOfOperations = [
    "(" => 3,
    ")" => 3,
    "^" => 2,
    "/" => 1,
    "*" => 1,
    "+" => 0,
    "-" => 0
];

echo $priorityOfOperations["1"];