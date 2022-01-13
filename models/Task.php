<?php
    namespace Taskforce\services;
    //include('TaskInterface.php');
    class Task implements TaskInterface
    {

        private $current_status = '';
        private $executor_id = '';
        private $customer_id = '';

        public function __construct(int $executor_id, int $customer_id) {
            //todo validation??
            $this->executor_id = $executor_id;
            $this->customer_id = $customer_id;
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
                     'customer' => [self::ACTION_CANCEL],
                     'executor' => [self::ACTION_AGREE]
                 ],
                 self::STATUS_PROCESS => [
                     'customer' => [self::ACTION_SUCCESS],
                     'executor' => [self::ACTION_FAIL]
                 ]
             ];
             return $actions[$status][$type];
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
