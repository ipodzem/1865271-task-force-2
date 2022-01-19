<?php
    namespace Taskforce\services;

    class AgreeAction extends TaskAction {

        public function getName() {
            return 'Откликнуться на задание';
        }
        public function getInnerName() {
            return Task::ACTION_AGREE;

        }
        public function checkAccess(int $executor_id, int $owner_id, int $user_id) {
            return ($executor_id == $user_id);
        }
    }
