<?php
    namespace Taskforce\services;

    abstract class TaskAction {

        abstract public function getName();
        abstract public function getInnerName();
        abstract public function checkAccess(int $executor_id, int $owner_id, int $user_id);
    }
