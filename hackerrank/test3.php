<?php

/*
 * Complete the 'timeInWords' function below.
 *
 * The function is expected to return a STRING.
 * The function accepts following parameters:
 *  1. INTEGER h
 *  2. INTEGER m
 */

function timeInWords($h, $m) {
    $val = array(
        "zero", "one", "two", "three", "four", "five", "six", "seven", "eight",
        "nine", "ten", "eleven", "twelve", "thirteen", "fourteen", "fifteen", "sixteen",
        "seventeen", "eighteen", "nineteen", "twenty", "twenty one", "twenty two",
        "twenty three", "twenty four", "twenty five", "twenty six", "twenty seven",
        "twenty eight", "twenty nine"
    );
    
    if ($m <= 30) {
        if ($m == 0) {
            echo $val[$h] . " o' clock";
        }
        else if ($m == 15) {
            echo "quarter past " . $val[$h];
        }
        else if ($m == 30) {
            echo "half past " . $val[$h];
        }
        else if ($m == 1) {
            echo $val[$m] . " minutes past " . $val[$h];
        }
        else {
            echo $val[$m] . " minutes past " . $val[$h];
        }
    }
    else {
        if ($m == 45) {
            echo "quarter to " . $val[$h + 1];
        }
        else if ($m == 59) {
            echo $val[60 - $m] . " minute to " . $val[$h + 1];
        }
        else {
            echo $val[60 - $m] . " minutes to " . $val[$h + 1];
        }
    }
}

$fptr = fopen(getenv("OUTPUT_PATH"), "w");

$h = intval(trim(fgets(STDIN)));

$m = intval(trim(fgets(STDIN)));

$result = timeInWords($h, $m);

fwrite($fptr, $result . "\n");

fclose($fptr);
