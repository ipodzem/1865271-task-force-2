<?php

function assert_failure($file, $line, $assertion, $message)
{
    echo "Проверка $assertion провалена: $message";
}


// настройки проверки
assert_options(ASSERT_ACTIVE,   true);
assert_options(ASSERT_BAIL,     true);
assert_options(ASSERT_WARNING,  false);
assert_options(ASSERT_CALLBACK, 'assert_failure');


include(dirname(__FILE__).'/models/Task.php');
$task = new Task(1, 1);
assert($task->getNextStatus('cancel_action') == Task::STATUS_CANCEL, 'cancel_action');
assert($task->getNextStatus('agree_action') == Task::STATUS_PROCESS, 'agree_action');
assert($task->getNextStatus('fail_action') == Task::STATUS_FAIL, 'fail_action');
assert($task->getNextStatus('success_action') == Task::STATUS_SUCCESS, 'success_action');
echo "Проверка завершена";

