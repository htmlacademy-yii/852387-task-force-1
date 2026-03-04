<?php
declare(strict_types=1);

namespace app\entities;

use app\enum\task\Action;

class ActionComplete extends AbstractAction
{
    protected Action $action = Action::ACTION_COMPLETE;

    /**
     * Метод проверки прав
     * @param int $currentUserId ID текущего пользователя
     * @param int $authorId ID автора задания
     * @param ?int $workerId ID исполнителя задания
     *
     * @return bool true/false
     **/
    public static function compareId(int $currentUserId, int $authorId, ?int $workerId): bool
    {
        return $currentUserId === $authorId;
    }
}
