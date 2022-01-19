<?php
    namespace Taskforce\services;

    class CancelAction extends TaskAction {

        public function getName() {
            return 'Отменить задание';
        }
        public function getInnerName() {
            return Task::ACTION_CANCEL;

        }
        public function checkAccess(int $executor_id, int $owner_id, int $user_id) {
            return ($owner_id == $user_id);
        }
    }
