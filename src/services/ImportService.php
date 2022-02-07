<?php

namespace Taskforce\services;

use Taskforce\datasets\CategoriesImport;
use Taskforce\datasets\CitiesImport;
use Taskforce\datasets\UsersImport;
use Taskforce\datasets\TasksImport;
use Taskforce\datasets\ProfilesImport;
use Taskforce\datasets\RepliesImport;
use Taskforce\datasets\RatingsImport;
use Taskforce\exceptions\BaseException;

class ImportService
{
    public static function generateSqlFiles(string $path): void
    {
        $data = [
            'users' => [
                'model' => new UsersImport(),
                'file' => 'users.sql'
            ],
            'cats' => [
                'model' => new CategoriesImport(),
                'file' => 'cats.sql'
            ],
            'cities' => [
                'model' => new CitiesImport(),
                'file' => 'cities.sql'
            ],
            'tasks' => [
                'model' => new TasksImport(),
                'file' => 'tasks.sql'
            ],
            'profiles' => [
                'model' => new ProfilesImport(),
                'file' => 'profiles.sql'
            ],
            'replies' => [
                'model' => new RepliesImport,
                'file' => 'replies.sql'
            ],
            'ratings' => [
                'model' => new RatingsImport,
                'file' => 'rate.sql'
            ],
        ];

        foreach ($data as $info) {
            if (!ImportService::saveTo($info['model'], $info ['file'], $path)) {
                throw BaseException('Problem with generating '.$info['file']);
            }
        }
    }
    private static function saveTo($model, string $file, string $path): bool
    {
        return (file_put_contents($path . $file, $model->sql()));
    }

}
