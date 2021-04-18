<?php
 
function convert($size)
{
    $unit=array('b','kb','mb','gb','tb','pb');
    return @round($size/pow(1024,($i=floor(log($size,1024)))),2).' '.$unit[$i];
}
ini_set('memory_limit', '20M');
$allocateMemoryInMB = intval($argv[1] ?? 512);
 
$buffer = [];
 
do {
    $buffer[] = str_repeat('1', 1024*1024);
    $memUsage = memory_get_usage(true);
    echo convert($memUsage).PHP_EOL; // 123 kb
} while ($memUsage < $allocateMemoryInMB*1024*1024);
 
echo 'Press any key..'.PHP_EOL;
 
$handle = fopen ("php://stdin","r");
$line = fgets($handle);
fclose($handle);
