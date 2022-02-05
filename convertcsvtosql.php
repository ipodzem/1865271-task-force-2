<?php

require(__DIR__ . '/vendor/autoload.php');

use Taskforce\services\ImportService;
$path = realpath(dirname(__FILE__)).'/data/sql/';

try {
    ImportService::generateSqlFiles($path);
    echo "Файлы сгенерированы в папку " . $path;
} catch (Exception $e) {
    echo 'Ошибка генерации файлов: ', $e->getMessage(), "\n";
}





