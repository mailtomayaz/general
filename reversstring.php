<?php

/* 
 * This code will revers any  string 
 * 
 */

// initilaztion
$str = "Muhammad Ayaz";
$x = 0;
// get string length
while((@$str[$x])!=null){
        $x++;
}
// print reverse string
while((@$str[$x-1])!=null){
        echo $str[$x-1];
$x--;
}