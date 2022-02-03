<?php

namespace Taskforce\datasets;

class CitiesImport extends Import
{
    const filename = '/data/cities.csv';
    const tablename = 'cities';
    public $filename;
    public $tablename;

    public function __construct()
    {
        $this->filename = $_SERVER['DOCUMENT_ROOT'] . self::filename;
        $this->tablename = self::tablename;
    }

    public function getCsvColumns()
    {
        return ['name', 'lat', 'long'];
    }

    public function getDbColumns()
    {
        return ['name' => 'name', 'lat' => 'lat', 'long' => 'long', 'country_id' => '1'];
    }

}
