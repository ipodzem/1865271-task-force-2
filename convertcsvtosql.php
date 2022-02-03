<?php

require(__DIR__ . '/vendor/autoload.php');

use Taskforce\datasets\CategoriesImport;
use Taskforce\datasets\CitiesImport;
use Taskforce\datasets\UsersImport;
use Taskforce\datasets\TasksImport;
use Taskforce\datasets\ProfilesImport;
use Taskforce\datasets\RepliesImport;
use Taskforce\datasets\RatingsImport;

function writeSql(string $name, string $text)
{
    $fp = fopen($name, 'w+');
    fwrite($fp, $text);
    fclose($fp);
}

$path = $_SERVER['DOCUMENT_ROOT'] . '/data/sql/';

try {
    $cats = new CategoriesImport();
    writeSql($path . 'cats.sql', $cats->sql());

    $users = new UsersImport();
    writeSql($path . 'users.sql', $users->sql());

    $cities = new CitiesImport();
    writeSql($path . 'cities.sql', $cities->sql());

    $tasks = new TasksImport();
    writeSql($path . 'tasks.sql', $tasks->sql());

    $profiles = new ProfilesImport();
    writeSql($path . 'profiles.sql', $profiles->sql());

    $replies = new RepliesImport();
    writeSql($path . 'replies.sql', $replies->sql());

    $ratings = new RatingsImport();
    writeSql($path . 'rate.sql', $ratings->sql());

    echo "Файлы сгенерированы в папку " . $path;
} catch (Exception $e) {
    echo 'Ошибка генерации файлов: ', $e->getMessage(), "\n";
}





