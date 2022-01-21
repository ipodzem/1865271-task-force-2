<?php
require(__DIR__.'/vendor/autoload.php');
use Taskforce\services\Task;
function assert_failure($file, $line, $assertion, $message)
{
    echo "Проверка $assertion провалена: $message";
}


// настройки проверки
assert_options(ASSERT_ACTIVE,   true);
assert_options(ASSERT_BAIL,     true);
assert_options(ASSERT_WARNING,  false);
assert_options(ASSERT_CALLBACK, 'assert_failure');

$task = new Task(2, 1);

assert($task->getNextStatus(Task::STATUS_NEW, Task::TYPE_CUSTOMER, 1) == Task::STATUS_CANCEL, 'cancel_action');
assert($task->getNextStatus(Task::STATUS_NEW, Task::TYPE_EXECUTOR, 2) == Task::STATUS_PROCESS, 'agree_action');
assert($task->getNextStatus(Task::STATUS_PROCESS, Task::TYPE_EXECUTOR, 2) == Task::STATUS_FAIL, 'fail_action');
assert($task->getNextStatus(Task::STATUS_PROCESS, Task::TYPE_CUSTOMER, 1) == Task::STATUS_SUCCESS, 'success_action');

//Задание в статусе «Новое» можно отменить, но сделать это может только автор задания.
assert($task->checkAction(Task::STATUS_NEW, Task::TYPE_CUSTOMER, 1) == true, 'Cancel task by owner');
//Задание в статусе «В работе» может иметь действие «Отказаться», но сделать это может только пользователь, чей ID совпадает с ID исполнителя задания;
assert($task->checkAction(Task::STATUS_PROCESS, Task::TYPE_EXECUTOR, 2) == true, 'Fail task by executor');
//Задание в статусе «В работе» может иметь действие «Завершить», но сделать это может только пользователь, чей ID совпадает с ID автора задания;
assert($task->checkAction(Task::STATUS_PROCESS, Task::TYPE_CUSTOMER, 1) == true,  'Finish task by owner');
//Провалена проверка для попытки отменить задание не его автором
assert($task->checkAction(Task::STATUS_NEW, Task::TYPE_CUSTOMER, 2) == true, 'Cancel task by owner');



echo "Проверка завершена";

