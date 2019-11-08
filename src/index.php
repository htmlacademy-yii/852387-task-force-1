<?php

use TaskForce\classes\Task;

require __DIR__ . '/../vendor/autoload.php';

$task = new Task();
var_dump(assert($task->getNextStatus('cancel') === 'cancel'));
var_dump(assert($task->getNextStatus('refuse') === 'fail'));
var_dump(assert($task->getNextStatus('execute') === 'done'));
var_dump(assert($task->getNextStatus('reply') === 'active'));
var_dump(assert($task->getNextStatus('new') === null));
// тест проходит как true
var_dump(assert($task->getNextStatus('1') === 'cancel'));
