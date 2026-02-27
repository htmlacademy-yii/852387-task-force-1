<?php
declare(strict_types=1);

namespace app\entities;

use app\enum\task\Action;
use app\enum\task\Status;

final class Task
{
    public int $ownerId;
    public ?int $workerId;
    public string $status;

    public function __construct(string $status, int $idOwner, ?int $idWorker)
    {
        $this->status = $status;
        $this->ownerId = $idOwner;
        $this->workerId = $idWorker;
    }

    /**
     * Метод для возврата статуса, в который перейдет задача для указанного действия
     * @param string $action действие над задачей
     * @return ?string возвращает статус задачи
     */
    public function getNextStatus(string $action): ?string
    {
        $currentAction = Action::tryFrom($action);
        return match ($currentAction) {
            Action::ACTION_CANCEL => Status::STATUS_CANCEL->value,
            Action::ACTION_APPROVE_WORKER => Status::STATUS_ACTIVE->value,
            Action::ACTION_COMPLETE => Status::STATUS_COMPLETE->value,
            Action::ACTION_REJECT => Status::STATUS_FAILED->value,
            default => null,
        };
    }

    /**
     * Метод для получения доступных действий для указанного статуса и роли пользователя(заказчик или исполнитель)
     * @param string $status статус задачи
     * @return ?object возвращает возможные действия в виде объекта действия
     */
    public function getAvailableAction(string $status, int $userId): ?object
    {
        $currentStatus = Status::tryFrom($status);
        $actions = match ($currentStatus) {
            Status::STATUS_NEW => [
                ActionCancel::class,
                ActionResponse::class
            ], //(cancel/отменить — для заказчика, response/откликнуться — для исполнителя)
            Status::STATUS_ACTIVE => [
                ActionComplete::class,
                ActionReject::class
            ], //  (complete/принять — для заказчика, reject/отказаться — для исполнителя)
            default => [],
        };

        foreach ($actions as $className) {
            if ($className::compareId($userId, $this->ownerId, $this->workerId)) {
                return new $className();
            }
        }
        return null;
    }

    /**
     * Метод для возврата «карты» статусов в виде ассоциативного массива.
     * @return array массив [ключ — внутреннее имя, а значение — названия статуса на русском]
     **/
    public function getStatusMap(): array
    {
        return Status::getTranslateStatusMap();
    }

    /**
     * Метод для возврата «карты» действий в виде ассоциативного массива.
     * @return array массив [ключ — внутреннее имя, а значение — названия статуса на русском]
     */
    public function getActionMap(): array
    {
        return Action::getTranslateActionMap();
    }
}
