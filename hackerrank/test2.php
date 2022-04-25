<?php

/*
 * Complete the 'plusMinus' function below.
 *
 * The function accepts INTEGER_ARRAY arr as parameter.
 */

function plusMinus($arr) {
    $positive = 0; $negative = 0; $zero = 0;
    
    foreach($arr as $value) {
        if($value > 0) {
            $positive++;
        } else if ($value < 0) {
            $negative++;
        } else {
            $zero++;
        }
    }
    // ambil variable $positive di bagi total array
    echo $positive / sizeOf($arr) . PHP_EOL;
    echo $negative / sizeOf($arr) . PHP_EOL;
    echo $zero / sizeOf($arr) . PHP_EOL;
}

$n = intval(trim(fgets(STDIN)));

$arr_temp = rtrim(fgets(STDIN));

$arr = array_map('intval', preg_split('/ /', $arr_temp, -1, PREG_SPLIT_NO_EMPTY));

plusMinus($arr);
