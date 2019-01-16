<?php

require_once 'lib.php';

$contents = '';

$contents .= '15 => ' . numberToString(15) . '<br />';
$contents .= '105 => ' . numberToString(105) . '<br />';
$contents .= '1000 => ' . numberToString(1000) . '<br />';
$contents .= '35000 => ' . numberToString(35000) . '<br />';
$contents .= '105000 => ' . numberToString(105000) . '<br />';
$contents .= '1000000 => ' . numberToString(1000000) . '<br />';
$contents .= '12500000000 => ' . numberToString(12500000000) . '<br />';
$contents .= '25550000000 => ' . numberToString(25550000000) . '<br />';

echo $contents;