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

        public function getStatusMap(string $status) : array {
            $map = [
                self::STATUS_NEW => [self::STATUS_CANCEL, self::STATUS_PROCESS],
                self::STATUS_PROCESS => [self::STATUS_SUCCESS, self::STATUS_FAIL]
            ];
            return $map[$status];
        }

        public function getActionMap(string $status, string $type) : AbstractAction{
            $actions = [
                 self::STATUS_NEW => [
                     self::TYPE_CUSTOMER => new CancelAction,
                     self::TYPE_EXECUTOR => new AgreeAction
                 ],
                 self::STATUS_PROCESS => [
                     self::TYPE_CUSTOMER => new SuccessAction,
                     self::TYPE_EXECUTOR => new FailAction
                 ]
             ];
             return $actions[$status][$type];
        }

        public function checkAction(string $status, string $type, int $user_id) : bool {
            $action = $this->getActionMap($status, $type);
            return $action->checkAccess($this->executor_id, $this->owner_id, $user_id);
        }

        public function getStatusName(string $status) : string {
             $statuses = [
                 self::STATUS_NEW     => 'Новый',
                 self::STATUS_FAIL    => 'Провален',
                 self::STATUS_PROCESS => 'В работе',
                 self::STATUS_CANCEL  => 'Отменен',
                 self::STATUS_SUCCESS => 'Завершен'
             ];
             return $statuses[$status];
        }

        public function getNextStatus(string $status, string $type, int $user_id) : string {
            $action = $this->getActionMap($status, $type);
            if ($action->checkAccess($this->executor_id, $this->owner_id, $user_id)) {
                return $action->getNextStatus();
            }
            return false;
        }
    }
