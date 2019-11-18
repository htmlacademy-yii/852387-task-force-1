<?php

use TaskForce\classes\AvailableAction;

require __DIR__ . '/../vendor/autoload.php';

$task = new AvailableAction();
var_dump($task::ACTION_TO_STATUS);
assert($task->getNextStatus('TaskForce\classes\ActionCancel') === $task::STATUS_CANCEL);
assert($task->getNextStatus('TaskForce\classes\ActionRefuse') === $task::STATUS_FAIL);
assert($task->getNextStatus('TaskForce\classes\ActionDone') === $task::STATUS_DONE);
assert($task->getNextStatus('TaskForce\classes\ActionReply') === $task::STATUS_ACTIVE);
assert($task->getNextStatus('new') === null);

assert($task->getNextStatus('1') === $task::STATUS_CANCEL);
