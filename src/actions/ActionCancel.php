<?php

namespace TaskForce\actions;

class ActionCancel extends Action
{
    public static function getTitle(): string
    {
        return 'отменить';
    }

    public static function getInnerName(): string
    {
        return 'cancel';
    }

    public static function compareId(int $currentUserId, ?int $workerId, int $clientId): bool
    {
        return  $currentUserId === $clientId;
    }
}
