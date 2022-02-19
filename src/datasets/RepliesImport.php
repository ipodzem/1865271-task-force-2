<?php

namespace Taskforce\datasets;

class RepliesImport extends Import
{
    const filename = '/data/replies.csv';
    const tablename = 'responses';
    public $filename;
    public $tablename;

    public function __construct()
    {
        $this->filename = realpath(dirname(__FILE__)."/../..") . self::filename;
        $this->tablename = self::tablename;
    }

    public function getCsvColumns(): array
    {
        return ['dt_add', 'rate', 'description'];
    }

    public function getDbColumns(): array
    {
        return [
            'created' => 'dt_add',
            'amount' => 'rate',
            'text' => 'description',
            'task_id' => 'random10',
            'user_id' => 'inc'
        ];
    }

}
