<?php

function Calc($string) 
{   
    $string = str_replace(' ', '', $string);

    if (is_numeric($string)) return (float)$string;

    $sizeString = strlen($string);
    
    $elements = [];
    $num = "";

    for ($i = 0; $i < $sizeString; $i++) {
        $char = $string[$i];
        if (is_numeric($char) || $char === ".") {
            $num .= $char;

            if ($i === $sizeString - 1) array_push($elements, $char);
        } else {
            if ($num !== "") array_push($elements, (float)$num);
            array_push($elements, $char);
            $num = "";
        }
        
    }

    $count = 0;

    foreach ($elements as $element) {
        if ($element === "(") $count += 1;
        else if ($element === ")") $count -= 1;

        if ($count === -1) throw new Exception("Ошибка. Неправильная расстановка скобок.");
    }

    if ($count !== 0) throw new Exception("Ошибка. Неправильная расстановка скобок.");

    $count_sign = 0;

    foreach ($elements as $element) {
        if (!is_numeric($element) && ($element !== "(" && $element !== ")")) {
            $count_sign += 1;
        } elseif (is_numeric($element)) {
            $count_sign -= 1;
        } 
        if ($count_sign === 1) throw new Exception("Ошибка. Неправильная расстановка операций.");
    }

    $polishNotation = [];
    $operationsStek = [];

    $priorityOfOperations = [
        "(" => 4,
        ")" => 4,
        "~" => 3,
        "^" => 2,
        "/" => 1,
        "*" => 1,
        "+" => 0,
        "-" => 0
    ];

    foreach ($elements as $element) {
        if (is_numeric($element)) {
            $polishNotation[] = $element;
        } else {
            
            if (count($operationsStek) === 0) {
                $operationsStek[] = $element;
                continue;
            } else {
                $headStek = $operationsStek[count($operationsStek) - 1];
            }
            
            if ($element === ")") {
                $temp = array_pop($operationsStek);
                while (count($operationsStek) > 0 && $temp !== "(") {
                    $polishNotation[] = $temp;
                    $temp = array_pop($operationsStek);
                }
                continue;
            }

            if ($priorityOfOperations[$headStek] < $priorityOfOperations[$element] || $headStek === "(" || $headStek === ")") {
                $operationsStek[] = $element;
            } else {
                $polishNotation[] = array_pop($operationsStek);
                $operationsStek[] = $element;
            }
        }
    }

    // Выписываем оставшиеся операции из $operationsStek в $polishNotation
    foreach ($operationsStek as $element) {
        $headStek = array_pop($operationsStek);

        $polishNotation[] = $headStek;
    }

    $stek = [];

    // Записываем в стек числа, иначе если операция, берем из 
    // стека два последних числа и ищем подходящую операцию.
    // Если такой операции нет - вызываем исключение.
    foreach ($polishNotation as $element) {
        if (is_numeric($element)) {
            $stek[] = $element;
        } else {
            $rightDigit = array_pop($stek);
            $leftDigit = array_pop($stek);

            switch ($element) {
                case "+":
                    $resultDigit = $leftDigit + $rightDigit;
                    break;
                case "-":
                    $resultDigit = $leftDigit - $rightDigit;
                    break;
                case "*":
                    $resultDigit = $leftDigit * $rightDigit;
                    break;
                case "/":
                    $resultDigit = $leftDigit / $rightDigit;
                    break;
                case "^":
                    $resultDigit = $leftDigit ** $rightDigit;
                    break;
                default:
                    throw new Exception("Ошибка. В выражении содержится неизвестная операция.");
            }

            $stek[] = $resultDigit;
        }
    }

    return $stek[0];

}

// $string = "2 + 5 - 4 * (1 + 3)";
$string = "2 ^ 3";
// $string = "1";

print_r(Calc($string));