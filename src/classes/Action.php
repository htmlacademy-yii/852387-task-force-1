<?php

namespace TaskForce\classes;

abstract class Action
{
    protected $title;
    protected $innerName;

    static protected $task = []; //array данные из базы данных

    private static function getCustomerId()
    {
        return self::task['customer_id'];
    }

    private static function getWorkerId()
    {
        return self::task['worker_id'];
    }

    abstract public function getTitle(): string;
    abstract public function getInnerName(): string;
    abstract public function compareId(): bool;
}
