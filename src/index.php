<?php

namespace TaskForce;

require 'Task.php';

$task = new Task();
assert($task->getNextStatus('cancel')==='cancel');
assert($task->getNextStatus('refuse')==='fail');
assert($task->getNextStatus('execute')==='done');
assert($task->getNextStatus('reply')==='active');
assert($task->getNextStatus('new') === null);
// тест проходит как true
assert($task->getNextStatus('1')==='cancel');
