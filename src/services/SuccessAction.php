<?php
    namespace Taskforce\services;

    class SuccessAction extends TaskAction {

        public function getName() {
            return 'Задание выполнено';
        }
        public function getInnerName() {
            return Task::ACTION_AGREE;
        }
        public function checkAccess(int $executor_id, int $owner_id, int $user_id) {
            return ($owner_id == $user_id);
        }
    }
