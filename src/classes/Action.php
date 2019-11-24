<?php

namespace TaskForce\classes;

abstract class Action
{
    abstract public static function getTitle(): string;
    abstract public static function getInnerName(): string;
    abstract public static function compareId(): bool;
}
