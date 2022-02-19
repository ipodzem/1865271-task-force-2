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
        $this->filename = realpath(dirname(__FILE__)."/../..") . self::filename;
        $this->tablename = self::tablename;
    }

    public function getCsvColumns(): array
    {
        return ['address', 'bd', 'about', 'phone', 'skype'];
    }

    public function getDbColumns(): array
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
