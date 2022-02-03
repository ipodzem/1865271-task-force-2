<?php

namespace Taskforce\datasets;

class ProfilesImport extends Import
{
    const filename = '/data/profiles.csv';
    const tablename = 'profiles';
    public $filename;
    public $tablename;

    public function __construct()
    {
        $this->filename = $_SERVER['DOCUMENT_ROOT'] . self::filename;
        $this->tablename = self::tablename;
    }

    public function getCsvColumns()
    {
        return ['address', 'bd', 'about', 'phone', 'skype'];
    }

    public function getDbColumns()
    {
        return [
            'address' => 'address',
            'bd' => 'bd',
            'about' => 'about',
            'phone' => 'phone',
            'skype' => 'skype',
            'user_id' => 'inc'
        ];
    }

}
