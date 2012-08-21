<?php
ini_set('error_reporting', 'E_all');
ini_set('display_errors', 1);

$time = microtime(); 
$time = explode(" ", $time); 
$time = $time[1] + $time[0]; 
$time2 = $time;

$totaltime = ($time2 - $time1); 
echo '<BR>Parsing Time: ' .$totaltime. ' seconds.';