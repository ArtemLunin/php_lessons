<?php
// подключение автогзагрузчика composer
require 'vendor/autoload.php';

// создание экземпляра http-клиента guzzle
$client = new \GuzzleHttp\Client();

// обходим содержимое csv-файла
$csv = \League\Csv\Reader::createFromPath($argv[1], 'r');
foreach ($csv as $csvRow) {
	try {
		// посылаем запрос HTTP OPTIONS
		$httpResponse = $client->options($csvRow[0]);
		// проверяем полученный код состояния HTTP
		if ($httpResponse->getStatusCode() >= 400) {
			throw new \Exception();
		}
	} catch (\Exception $e) {
		// URL недоступен
		echo $csvRow[0] . PHP_EOL;
	}
}