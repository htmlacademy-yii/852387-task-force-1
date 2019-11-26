<?php

use TaskForce\classes\AvailableActions;

require __DIR__ . '/../vendor/autoload.php';

$task = new AvailableActions('new', 2, 4);
var_dump($task);

assert($task->getNextStatus('TaskForce\classes\ActionCancel') === $task::STATUS_CANCEL);
assert($task->getNextStatus('TaskForce\classes\ActionRefuse') === $task::STATUS_FAIL);
assert($task->getNextStatus('TaskForce\classes\ActionDone') === $task::STATUS_DONE);
assert($task->getNextStatus('TaskForce\classes\ActionReply') === $task::STATUS_ACTIVE);
assert($task->getNextStatus('new') === null);

assert($task->getNextStatus('1') !== $task::STATUS_CANCEL);

assert($task->getAvailableActions('worker', 2) === []);
assert($task->getAvailableActions('worker', 0) === [$task::ACTION_REPLY]);
assert($task->getAvailableActions('worker', 6) === [$task::ACTION_REPLY]);
assert($task->getAvailableActions('client', 4) === [$task::ACTION_CANCEL]);

$task2 = new AvailableActions('cancel', 2, 4);
assert($task2->getAvailableActions('worker', 2) === []);
assert($task2->getAvailableActions('worker', 3) === []);
assert($task2->getAvailableActions('client', 4) === []);

$task3 = new AvailableActions('done', 2, 4);
assert($task3->getAvailableActions('worker', 2) === []);
assert($task3->getAvailableActions('client', 3) === []);
assert($task3->getAvailableActions('client', 9) === []);

$task4 = new AvailableActions('fail', 2, 4);
assert($task4->getAvailableActions('worker', 2) === []);
assert($task4->getAvailableActions('worker', 3) === []);
assert($task4->getAvailableActions('client', 4) === []);

$task5 = new AvailableActions('active', 2, 4);
assert($task5->getAvailableActions('worker', 2) === [$task5::ACTION_REFUSE]);
assert($task5->getAvailableActions('worker', 3) === []);
assert($task5->getAvailableActions('client', 4) === [$task5::ACTION_DONE]);
assert($task5->getAvailableActions('client', 9) === []);
