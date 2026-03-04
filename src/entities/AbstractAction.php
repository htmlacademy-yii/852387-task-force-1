<?php
declare(strict_types=1);

namespace app\entities;

use app\enum\task\Action;

abstract class AbstractAction
{
    protected Action $action;
    /**
     * Метод возврата названия действия на русском языке
     * @return string
     **/
    public function getNotation(): string
    {
        return Action::getTranslateActionMap()[$this->getName()];
    }

    /**
     * Метод получения внутреннего названия действия
     * @return string
     **/
    public function getName(): string
    {
        return $this->action->value;
    }

    /**
     * Метод проверки прав
     * @param int $currentUserId ID текущего пользователя
     * @param int $authorId ID автора задания
     * @param ?int $workerId ID исполнителя задания
     *
     * @return bool true/false
    **/
    abstract public static function compareId(int $currentUserId, int $authorId, ?int $workerId): bool;
}
