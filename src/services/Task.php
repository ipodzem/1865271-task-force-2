<?php
    namespace Taskforce\services;

    class Task implements TaskInterface
    {

        private $current_status = '';
        private $executor_id = '';
        private $owner_id = '';

        public function __construct(int $executor_id, int $owner_id) {
            //todo validation??
            $this->executor_id = $executor_id;
            $this->owner_id = $owner_id;
        }

        public function getStatusMap(string $status)
        {
            $map = [
                self::STATUS_NEW => [self::STATUS_CANCEL, self::STATUS_PROCESS],
                self::STATUS_PROCESS => [self::STATUS_SUCCESS, self::STATUS_FAIL]
            ];
            return $map[$status];
        }

        public function getActionMap(string $status, string $type)
        {
            $actions = [
                 self::STATUS_NEW => [
                     self::TYPE_CUSTOMER => [Task::ACTION_CANCEL => new CancelAction],
                     self::TYPE_EXECUTOR => [Task::ACTION_AGREE => new AgreeAction]
                 ],
                 self::STATUS_PROCESS => [
                     self::TYPE_CUSTOMER => [Task::ACTION_SUCCESS => new SuccessAction],
                     self::TYPE_EXECUTOR => [Task::ACTION_FAIL => new FailAction]
                 ]
             ];
             return $actions[$status][$type];
        }

        public function checkAction(string $status, string $type, int $user_id, string $action){
            $actions = $this->getActionMap($status, $type);
            if (isset($actions[$action]))
                return $actions[$action]->checkAccess($this->executor_id, $this->owner_id, $user_id);
            else
                return false;

        }

        public function getNextStatus(string $action)
        {
            $action_to_status = [
                self::ACTION_CANCEL  => self::STATUS_CANCEL,
                self::ACTION_AGREE   => self::STATUS_PROCESS,
                self::ACTION_SUCCESS => self::STATUS_SUCCESS,
                self::ACTION_FAIL    => self::STATUS_FAIL
            ];
            return $action_to_status[$action];
        }

        public function getStatusName(string $status)
        {
             $statuses = [
                 self::STATUS_NEW     => 'Новый',
                 self::STATUS_FAIL    => 'Провален',
                 self::STATUS_PROCESS => 'В работе',
                 self::STATUS_CANCEL  => 'Отменен',
                 self::STATUS_SUCCESS => 'Завершен'
             ];
             return $statuses[$status];
        }

        public function getActionName(string $action)
        {
             $actions = [
                 self::ACTION_FAIL    => 'Отказаться',
                 self::ACTION_SUCCESS => 'Завершить',
                 self::ACTION_AGREE   => 'Откликнуться',
                 self::ACTION_CANCEL  => 'Отменить'
             ];
             return $actions[$action];
        }
    }
