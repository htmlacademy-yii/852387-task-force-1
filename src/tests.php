<?php

use TaskForce\classes\Task;

require __DIR__ . '/../vendor/autoload.php';

$task = new Task();
assert($task->getNextStatus('cancel') === $task::STATUS_CANCEL);
assert($task->getNextStatus('refuse') === $task::STATUS_FAIL);
assert($task->getNextStatus('execute') === $task::STATUS_DONE);
assert($task->getNextStatus('reply') === $task::STATUS_ACTIVE);
assert($task->getNextStatus('new') === null);

assert($task->getNextStatus('1') === $task::STATUS_CANCEL);
