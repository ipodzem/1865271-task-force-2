<?php

namespace Taskforce\services;

interface TaskInterface
{
    const STATUS_NEW = 'new';
    const STATUS_CANCEL = 'cancel';
    const STATUS_FAIL = 'fail';
    const STATUS_PROCESS = 'process';
    const STATUS_SUCCESS = 'success';
    const STATUS_ARCHIVE = 'archive';

    const TYPE_CUSTOMER = 'customer';
    const TYPE_EXECUTOR = 'executor';

    public function __construct(int $executor_id, int $customer_id, string $status);

    public function getStatusMap(): array;

    public function getActionMap(string $type): AbstractAction;

    public function getStatusName(): string;

    public function getNextStatus(string $type, int $user_id): string;

}
