<?php

namespace TaskForce\classes;

class ActionReply extends Action
{
    public static function getTitle(): string
    {
        return 'откликнуться';
    }

    public static function getInnerName(): string
    {
        return 'reply';
    }

    public static function compareId(int $currentUserId, ?int $workerId, int $clientId): bool
    {
        return  $currentUserId !== $clientId && $currentUserId !== $workerId;
    }
}
