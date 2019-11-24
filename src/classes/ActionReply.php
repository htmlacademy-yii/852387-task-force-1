<?php

namespace TaskForce\classes;

class ActionReply extends Action
{
    public function getTitle(): string
    {
        return 'откликнуться';
    }

    public function getInnerName(): string
    {
        return 'reply';
    }

    public function compareId(int $currentUserId, ?int $workerId, int $clientId): bool
    {
        return  $currentUserId !== $clientId;
    }
}
