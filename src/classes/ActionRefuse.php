<?php

namespace TaskForce\classes;

class ActionRefuse extends Action
{
    private function __construct()
    {
        $this->title = 'Отказаться';
        $this->innerName = 'refuse';
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
        return  $currentUserId === self::getWorkerId();
    }
}
