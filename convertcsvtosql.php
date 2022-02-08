<?php

require(__DIR__ . '/vendor/autoload.php');

use Taskforce\services\ImportService;
use Taskforce\datasets\CategoriesImport;
use Taskforce\datasets\CitiesImport;
use Taskforce\datasets\UsersImport;
use Taskforce\datasets\TasksImport;
use Taskforce\datasets\ProfilesImport;
use Taskforce\datasets\RepliesImport;
use Taskforce\datasets\RatingsImport;

$path = realpath(dirname(__FILE__)) . '/data/sql/';

try {
    (new ImportService(new UsersImport()))->saveTo($path . "users.sql");
    (new ImportService(new TasksImport()))->saveTo($path . "tasks.sql");
    (new ImportService(new CategoriesImport()))->saveTo($path . "cats.sql");
    (new ImportService(new CitiesImport()))->saveTo($path . "cities.sql");
    (new ImportService(new ProfilesImport()))->saveTo($path . "profiles.sql");
    (new ImportService(new RepliesImport()))->saveTo($path . "replies.sql");
    (new ImportService(new RatingsImport()))->saveTo($path . "ratings.sql");
    echo "Файлы сгенерированы в папку " . $path;
} catch (Exception $e) {
    echo 'Ошибка генерации файлов: ', $e->getMessage(), "\n";
}





