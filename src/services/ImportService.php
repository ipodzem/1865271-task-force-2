<?php

namespace Taskforce\services;

use Taskforce\datasets\CategoriesImport;
use Taskforce\datasets\CitiesImport;
use Taskforce\datasets\UsersImport;
use Taskforce\datasets\TasksImport;
use Taskforce\datasets\ProfilesImport;
use Taskforce\datasets\RepliesImport;
use Taskforce\datasets\RatingsImport;

class ImportService
{
    function generateSqlFiles(string $path)
    {
        $cats = new CategoriesImport();
        file_put_contents($path . 'cats.sql', $cats->sql());

        $users = new UsersImport();
        file_put_contents($path . 'users.sql', $users->sql());

        $cities = new CitiesImport();
        file_put_contents($path . 'cities.sql', $cities->sql());

        $tasks = new TasksImport();
        file_put_contents($path . 'tasks.sql', $tasks->sql());

        $profiles = new ProfilesImport();
        file_put_contents($path . 'profiles.sql', $profiles->sql());

        $replies = new RepliesImport();
        file_put_contents($path . 'replies.sql', $replies->sql());

        $ratings = new RatingsImport();
        file_put_contents($path . 'rate.sql', $ratings->sql());
    }

}
