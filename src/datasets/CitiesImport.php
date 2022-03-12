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
        $this->filename = realpath(dirname(__FILE__)."/../..") . self::filename;
        $this->tablename = self::tablename;
    }

    public function getCsvColumns(): array
    {
        return ['﻿name', 'lat', 'long'];
    }

    public function getDbColumns(): array
    {
        return ['name' => 'name', 'lat' => 'lat', 'long' => 'long', 'country_id' => '1'];
    }

}
