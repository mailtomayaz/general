<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

if (class_exists('Memcache')) {
    $meminstance = new Memcache();
} else {
    $meminstance = new Memcached();
}

$meminstance->addServer("127.0.0.1", 11211);

$result = $meminstance->get("test");

if ($result) {
    echo $result;
} else {
    echo "No matching key found.  Refresh the browser to add it!";
    $meminstance->set("test", "Successfully retrieved the data!") or die("Couldn't save anything to memcached...");
}