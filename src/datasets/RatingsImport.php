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
        $this->filename = $_SERVER['DOCUMENT_ROOT'] . self::filename;
        $this->tablename = self::tablename;
    }

    public function getCsvColumns()
    {
        return ['dt_add', 'rate', 'description'];
    }

    public function getDbColumns()
    {
        return ['created' => 'dt_add', 'rating' => 'rate', 'comment' => 'description', 'response_id' => 'random10'];
    }

}
