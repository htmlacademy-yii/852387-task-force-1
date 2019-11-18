<?php

namespace TaskForce\classes;

class ActionReply extends Action
{
    private function __construct()
    {
        $this->title = 'Откликнуться';
        $this->innerName = 'reply';
    }

    public function getTitle(): string
    {
        return $this->title;
    }

    public function getInnerName(): string
    {
        return $this->innerName;
    }

    public function compareId($currentUserId): bool
    {
        return  $currentUserId !== self::getCustomerId();
    }
}
