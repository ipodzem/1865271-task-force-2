<?php

namespace Taskforce\services;

class CancelAction extends AbstractAction
{

    public function getName(): string
    {
        return 'Отменить задание';
    }
        
    public function checkAccess(int $executor_id, int $owner_id, int $user_id): bool
    {
        return ($owner_id == $user_id);
    }

    public function getNextStatus(): string
    {
        return Task::STATUS_CANCEL;
    }
}
