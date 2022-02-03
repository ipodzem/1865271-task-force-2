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
        $this->filename = $_SERVER['DOCUMENT_ROOT'] . self::filename;
        $this->tablename = self::tablename;
    }

    public function getCsvColumns()
    {
        return ['name', 'icon'];
    }

    public function getDbColumns()
    {
        return ['name' => 'name', 'icon' => 'icon'];
    }

}
