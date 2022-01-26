<?php
    namespace Taskforce\services;

    abstract class AbstractAction {

        abstract public function getName() : string;
        abstract public function checkAccess(int $executor_id, int $owner_id, int $user_id) : bool;
        abstract public function getNextStatus() : string;
    }
