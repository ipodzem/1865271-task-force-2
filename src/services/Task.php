<?php

namespace Taskforce\services;

use Couchbase\DocumentNotFoundException;
use Taskforce\exceptions\TaskException;

class Task implements TaskInterface
{

    private $status = '';
    private $executor_id = '';
    private $owner_id = '';

    public function __construct(int $executor_id, int $owner_id, string $status)
    {
        //todo validation??
        $this->executor_id = $executor_id;
        $this->owner_id = $owner_id;

        $this->checkStatus($status);


        $this->status = $status;
    }

    public function getStatusMap(): array
    {
        $map = [
            self::STATUS_NEW => [self::STATUS_CANCEL, self::STATUS_PROCESS],
            self::STATUS_PROCESS => [self::STATUS_SUCCESS, self::STATUS_FAIL]
        ];
        return $map[$this->status];
    }

    public function getActionMap(string $type): AbstractAction
    {
        $this->checkType($type);
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
        return $actions[$this->status][$type];
    }

    public function checkAction(string $type, int $user_id): bool
    {
        $action = $this->getActionMap($type);
        return $action->checkAccess($this->executor_id, $this->owner_id, $user_id);
    }

    public function getStatusName(): string
    {
        $statuses = [
            self::STATUS_NEW => 'Новый',
            self::STATUS_FAIL => 'Провален',
            self::STATUS_PROCESS => 'В работе',
            self::STATUS_CANCEL => 'Отменен',
            self::STATUS_SUCCESS => 'Завершен'
        ];
        return $statuses[$this->status];
    }

    public function checkStatus(string $status): bool
    {
        if (!in_array(
            $status,
            [self::STATUS_NEW, self::STATUS_FAIL, self::STATUS_PROCESS, self::STATUS_CANCEL, self::STATUS_SUCCESS]
        )) {
            throw new TaskException("Wrong status");
        }
        return true;
    }

    public function checkType(string $type): bool
    {
        if (!in_array($type, [self::TYPE_CUSTOMER, self::TYPE_EXECUTOR])) {
            throw new TaskException("Wrong type");
        }
        return true;
    }

    public function getNextStatus(string $type, int $user_id): string
    {
        $action = $this->getActionMap($type);
        if ($action->checkAccess($this->executor_id, $this->owner_id, $user_id)) {
            return $action->getNextStatus();
        }
        return false;
    }
}
