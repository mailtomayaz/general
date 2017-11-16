<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

$a = array(
      'blue' => 'nice',
      'car' => 'fast',
      'number' => 'none'
  );  
var_dump(array_search('car', array_keys($a)));
var_dump($_POST);
//var_dump(array_search('blue', array_keys($a)));
//var_dump(array_search('number', array_keys($a)));