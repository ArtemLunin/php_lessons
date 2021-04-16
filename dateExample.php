<?php
$dateStart = new DateTime();
// определяет интервал между соседними датами
$dateInterval = DateInterval::createFromDateString('-1 day');
// оперделяет кол-во дат
$datePeriod = new DatePeriod($dateStart, $dateInterval, 30);
foreach($datePeriod as $date) {
    echo $date->format('Y-m-d') . PHP_EOL;
}