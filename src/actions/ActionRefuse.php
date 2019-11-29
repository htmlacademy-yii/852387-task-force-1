<?php

namespace TaskForce\actions;

class ActionRefuse extends Action
{
    public static function getTitle(): string
    {
        return 'отказаться';
    }

    public static function getInnerName(): string
    {
        return 'refuse';
    }

    public static function compareId(int $currentUserId, ?int $workerId, int $clientId): bool
    {
        return  $currentUserId === $workerId;
    }
}
