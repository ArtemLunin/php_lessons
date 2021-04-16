<?php 
// подключение автозагрузчика composer
require 'vendor/autoload.php';
// импорт пространства имен Monolog
use Monolog\Logger;
use Monolog\Handler\StreamHandler;

// Зарегистрировать Monolog
// $log = new Logger('my-app-name');
// $log->pushHandler(new StreamHandler('error_log.txt', logger::WARNING));

$whoops = new Whoops\Run;
$whoops->pushHandler(new Whoops\Handler\PrettyPageHandler);
$whoops->register();

$b = 10 / 0;
echo $b;
echo "test" . PHP_EOL;
// phpinfo();
?>