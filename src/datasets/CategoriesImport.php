<?php

namespace Taskforce\datasets;

class CategoriesImport extends Import
{
    const filename = '/data/categories.csv';
    const tablename = 'categories';
    public $filename;
    public $tablename;

    public function __construct()
    {
        $this->filename = realpath(dirname(__FILE__)."/../..") . self::filename;
        $this->tablename = self::tablename;
    }

    public function getCsvColumns(): array
    {
        return ['name', 'icon'];
    }

    public function getDbColumns(): array
    {
        return ['name' => 'name', 'icon' => 'icon'];
    }

}
