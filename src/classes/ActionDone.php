<?php

namespace TaskForce\classes;

class ActionDone extends Action
{
    private function __construct()
    {
        $this->title = 'Выполнено';
        $this->innerName = 'Done';
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
        return  $currentUserId === self::getCustomerId();
    }
}
