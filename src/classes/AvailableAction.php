<?php

namespace TaskForce\classes;

class AvailableAction
{
    const STATUS_NEW = 'new';
    const STATUS_CANCEL = 'cancel';
    const STATUS_DONE = 'done';
    const STATUS_FAIL = 'fail';
    const STATUS_ACTIVE = 'active';

    const ACTION_CANCEL = ActionCancel::class;
    const ACTION_REFUSE = ActionRefuse::class;
    const ACTION_DONE = ActionDone::class;
    const ACTION_REPLY = ActionReply::class;

    const ROLE_CUSTOMER = 'customer';
    const ROLE_WORKER = 'worker';

    const ACTIONS_MAP = [
        self::STATUS_NEW => [
            self::ROLE_CUSTOMER => self::ACTION_CANCEL,
            self::ROLE_WORKER => self::ACTION_REPLY
        ],
        self::STATUS_CANCEL => [],
        self::STATUS_DONE => [],
        self::STATUS_FAIL => [],
        self::STATUS_ACTIVE => [
            self::ROLE_CUSTOMER => self::ACTION_DONE,
            self::ROLE_WORKER => self::ACTION_REFUSE
        ]
    ];

    const ACTION_TO_STATUS = [
        self::ACTION_CANCEL => self::STATUS_CANCEL,
        self::ACTION_REFUSE => self::STATUS_FAIL,
        self::ACTION_DONE => self::STATUS_DONE,
        self::ACTION_REPLY => self::STATUS_ACTIVE
    ];

    /**
     * Метод для возврата статуса, в который перейдет задача для указанного действия
     * getNextStatus
     *
     * @param string $action название класса-действия
     *
     * @return string
     */
    public static function getNextStatus($action)
    {
        return self::ACTION_TO_STATUS[$action];
    }

    /**
     * Метод для получения списка доступных действий getListAvailableActions
     *
     * @param string  $role   роль
     * @param integer $userId id пользователя
     *
     * @return array
     */
    public function getListAvailableActions($role, $userId)
    {
        $currentTask = new Task($data = []);
        $currentStatusTask = $currentTask->getStatusTask();
        $workerId = $currentTask->getWorkerId();
        $customerId = $currentTask->getCustomerId();

        if (empty(self::ACTIONS_MAP[$currentStatusTask])) {
            return [];
        } elseif ($userId === $customerId || $userId === $workerId) {
            return self::ACTIONS_MAP[$currentStatusTask][$role];
        } elseif ($userId !== $customerId && $role === self::ROLE_WORKER && $currentStatusTask === self::STATUS_NEW) {
            return self::ACTIONS_MAP[$currentStatusTask][$role];
        }
        return [];
    }
}
