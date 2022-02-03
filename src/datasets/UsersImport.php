<?php

namespace Taskforce\datasets;

class UsersImport extends Import
{
    const filename = '/data/users.csv';
    const tablename = 'users';
    public $filename;
    public $tablename;

    public function __construct()
    {
        $this->filename = $_SERVER['DOCUMENT_ROOT'] . self::filename;
        $this->tablename = self::tablename;
    }

    public function getCsvColumns()
    {
        return ['email', 'name', 'password', 'dt_add'];
    }

    public function getDbColumns()
    {
        return ['email' => 'email', 'name' => 'name', 'password' => 'password', 'created' => 'dt_add'];
    }

}
