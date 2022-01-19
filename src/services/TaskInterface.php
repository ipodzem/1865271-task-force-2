<?php

namespace Taskforce\services;

interface TaskInterface
{
    const STATUS_NEW     = 'new';
    const STATUS_CANCEL  = 'cancel';
    const STATUS_FAIL    = 'fail';
    const STATUS_PROCESS = 'process';
    const STATUS_SUCCESS = 'success';
    const STATUS_ARCHIVE = 'archive';

    const ACTION_CANCEL  = 'cancel_action';
    const ACTION_AGREE   = 'agree_action';
    const ACTION_SUCCESS = 'success_action';
    const ACTION_FAIL    = 'fail_action';
    const ACTION_ARCHIVE = 'archive_action';

    CONST TYPE_CUSTOMER  = 'customer';
    CONST TYPE_EXECUTOR  = 'executor';


    public function __construct(int $executor_id, int $customer_id);

    public function getStatusMap(string $status);

    public function getActionMap(string $status, string $type);

    public function getNextStatus(string $action);

    public function getStatusName(string $status);

    public function getActionName(string $action);
}
