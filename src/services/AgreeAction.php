<?php

namespace Taskforce\services;

class AgreeAction extends AbstractAction
{

    public function getName(): string
    {
        return 'Откликнуться на задание';
    }
        
    public function checkAccess(int $executor_id, int $owner_id, int $user_id): bool
    {
        return ($executor_id == $user_id);
    }

    public function getNextStatus(): string
    {
        return Task::STATUS_PROCESS;
    }
}
