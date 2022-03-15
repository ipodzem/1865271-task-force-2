<?php

namespace Taskforce\datasets;

use Taskforce\services\Task;

class TasksImport extends Import
{
    const filename = '/data/tasks.csv';
    const tablename = 'tasks';
    public $filename;
    public $tablename;

    public function __construct()
    {
        $this->filename = realpath(dirname(__FILE__)."/../..") . self::filename;
        $this->tablename = self::tablename;
    }

    public function getCsvColumns(): array
    {
        return ['dt_add', 'category_id', 'description', 'expire', 'name', 'address', 'budget', 'lat', 'long'];
    }

    public function getDbColumns(): array
    {
        return [
            'created' => 'dt_add',
            'category_id' => 'category_id',
            'description' => 'description',
            'term' => 'expire',
            'name' => 'name',
            'address' => 'address',
            'budget' => 'budget',
            'lat' => 'lat',
            'long' => 'long',
            'user_id' => 'inc',
            'status' => Task::STATUS_NEW
        ];
    }

}
