<?php

namespace TaskForce\actions;

class ActionDone extends Action
{
    public static function getTitle(): string
    {
        return 'выполнено';
    }

    public static function getInnerName(): string
    {
        return 'done';
    }

    public static function compareId(int $currentUserId, ?int $workerId, int $clientId): bool
    {
        return  $currentUserId === $clientId;
    }
}
