<?php
declare(strict_types=1);

namespace app\entities;

class ActionReject extends Action
{
    /**
     * Метод возврата названия действия на русском языке
     * @return string
     **/
    public function getNotation(): string
    {
        return 'отказаться';
    }

    /**
     * Метод получения внутреннего названия действия
     * @return string
     **/
    public function getName(): string
    {
        return 'reject';
    }

    /**
     * Метод проверки прав
     * @param int $currentUserId ID заказчика задания
     * @param int $ownerId ID текущего пользователя
     * @param ?int $workerId ID исполнителя задания
     *
     * @return bool true/false
     **/
    public static function compareId(int $currentUserId, int $ownerId, ?int $workerId): bool
    {
        return $currentUserId === $workerId;
    }
}
