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

    CONST TYPE_CUSTOMER  = 'customer';
    CONST TYPE_EXECUTOR  = 'executor';


    public function __construct(int $executor_id, int $customer_id);

    public function getStatusMap(string $status) : array;

    public function getActionMap(string $status, string $type) : object;

    public function getStatusName(string $status) : string;

    public function getNextStatus(string $status, string $type, int $user_id) : string;

}
