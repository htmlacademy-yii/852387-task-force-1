<?php
declare(strict_types=1);

require_once 'Task.php';

$task = new Task(2, 1);
assert($task->getNextStatus('cancel') === Task::STATUS_CANCEL, 'cancel');
assert($task->getNextStatus('response') === null, null);
assert($task->getNextStatus('approve_worker') === Task::STATUS_ACTIVE, 'active');
assert($task->getNextStatus('accept') === Task::STATUS_READY, 'ready');
assert($task->getNextStatus('reject') === Task::STATUS_FAILED, 'failed');
// ожидается 'cancel'
assert($task->getNextStatus('1') !== Task::STATUS_CANCEL, 'cancel');
assert($task->getNextStatus((string)null) !== Task::STATUS_ACTIVE, 'active');

assert($task->getActions('new') === Task::STATUS_TO_ACTIONS[Task::STATUS_NEW], "Ожидает массив ['cancel', 'approve_worker']");
assert($task->getActions('cancel') === Task::STATUS_TO_ACTIONS[Task::STATUS_CANCEL], "Ожидает пустой []");
assert($task->getActions('active') === Task::STATUS_TO_ACTIONS[Task::STATUS_ACTIVE], "Ожидает пустой ['accept', 'reject']");
assert($task->getActions('ready') === Task::STATUS_TO_ACTIONS[Task::STATUS_READY], "Ожидает пустой []");
assert($task->getActions('failed') === Task::STATUS_TO_ACTIONS[Task::STATUS_FAILED], "Ожидает пустой []");
// ожидается 'cancel'
assert($task->getActions('') !== Task::STATUS_TO_ACTIONS[Task::STATUS_CANCEL], 'cancel');