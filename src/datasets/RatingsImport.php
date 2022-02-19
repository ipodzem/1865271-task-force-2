<?php

namespace Taskforce\datasets;

class RatingsImport extends Import
{
    const filename = '/data/opinions.csv';
    const tablename = 'ratings';
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
        return ['created' => 'dt_add', 'rating' => 'rate', 'comment' => 'description', 'response_id' => 'random10'];
    }

}
