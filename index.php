<?php 
// подключение автозагрузчика composer
require 'vendor/autoload.php';
// импорт пространства имен Monolog
use Monolog\Logger;
use Monolog\Handler\StreamHandler;
use Monolog\Formatter\LineFormatter;
use Monolog\Formatter\JsonFormatter;
use Monolog\Formatter\HtmlFormatter;


// $log->pushHandler((new StreamHandler('error_log.txt', logger::INFO))->setFormatter(new HtmlFormatter()));

// log levels
// DEBUG, INFO, NOTICE, WARNING, ERROR, CRITICAL, ALERT, EMERGENCY

// the default date format is "Y-m-d\TH:i:sP"
$dateFormat = "Y-m-d H:i:s.v";
// the default output format is "[%datetime%] %channel%.%level_name%: %message% %context% %extra%\n"
$output = "[%datetime%] %channel%.%level_name%: %message% %context% %extra%\n";
// finally, create a formatter
$formatter = new LineFormatter($output, $dateFormat);

// Create a handler
$stream = new StreamHandler(__DIR__.'/my_app.log', Logger::DEBUG);

$stream->setFormatter($formatter);

$stream_handler = new StreamHandler(__DIR__.'/my_app.log', Logger::WARNING, false);
$stream_handler->setFormatter(new JsonFormatter(JsonFormatter::BATCH_MODE_JSON, true, true));

// Зарегистрировать Monolog
$log = new Logger('my-app-name');

$log->pushHandler($stream);
$log->pushHandler($stream_handler);

$log->pushProcessor(function ($record) {
    $record['extra']['dummy'] = 'Hello world!';
    return $record;
});


// $whoops = new Whoops\Run;
// $whoops->pushHandler(new Whoops\Handler\PrettyPageHandler);
// $whoops->register();

// $b = 10 / 0;
try {
    throw new Exception("Error Processing Request", 1);
}
catch (Exception $e) {
    $log->info('Test:'.$e->getMessage());
    //log with context
    // $log->warning('Warning', ['username' => 'Seldaek']);
    $log->warning('Warning');
}
echo memory_get_peak_usage() . " bytes" . PHP_EOL;


// phpinfo();
?>