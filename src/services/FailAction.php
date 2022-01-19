<?php
    namespace Taskforce\services;

    class FailAction extends TaskAction {

        public function getName() {
            return 'Отказаться от задания';
        }
        public function getInnerName() {
            return Task::ACTION_FAIL;

        }
        public function checkAccess(int $executor_id, int $owner_id, int $user_id) {
            return ($executor_id == $user_id);
        }
    }
