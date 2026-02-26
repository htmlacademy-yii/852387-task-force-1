<?php
declare(strict_types=1);

namespace app\entities;

abstract class Action
{
    /**
     * Метод возврата названия действия на русском языке
     * @return string
    **/
    abstract public function getNotation(): string;

    /**
     * Метод получения внутреннего названия действия
     * @return string
    **/
    abstract public function getName(): string;

    /**
     * Метод проверки прав
     * @param int $currentUserId ID заказчика задания
     * @param int $ownerId ID текущего пользователя
     * @param ?int $workerId ID исполнителя задания
     *
     * @return bool true/false
    **/
    abstract public static function compareId(int $currentUserId, int $ownerId, ?int $workerId): bool;
}
