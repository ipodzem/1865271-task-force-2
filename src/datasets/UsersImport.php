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
        $this->filename = realpath(dirname(__FILE__)."/../..") . self::filename;
        $this->tablename = self::tablename;
    }

    public function getCsvColumns(): array
    {
        return ['email', 'name', 'password', 'dt_add'];
    }

    public function getDbColumns(): array
    {
        return ['email' => 'email', 'name' => 'name', 'password' => 'password', 'created' => 'dt_add'];
    }

}
