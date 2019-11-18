<?php

namespace TaskForce\classes;

class ActionCancel extends Action
{
    private function __construct()
    {
        $this->title = 'Отменить';
        $this->innerName = 'cancel';
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
