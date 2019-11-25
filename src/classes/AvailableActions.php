<?php

namespace TaskForce\classes;

class AvailableActions
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

    const ROLE_CLIENT = 'client';
    const ROLE_WORKER = 'worker';

    const ACTIONS_MAP = [
        self::STATUS_NEW => [
            self::ROLE_CLIENT => self::ACTION_CANCEL,
            self::ROLE_WORKER => self::ACTION_REPLY
        ],
        self::STATUS_CANCEL => [],
        self::STATUS_DONE => [],
        self::STATUS_FAIL => [],
        self::STATUS_ACTIVE => [
            self::ROLE_CLIENT => self::ACTION_DONE,
            self::ROLE_WORKER => self::ACTION_REFUSE
        ]
    ];

    const ACTION_TO_STATUS = [
        self::ACTION_CANCEL => self::STATUS_CANCEL,
        self::ACTION_REFUSE => self::STATUS_FAIL,
        self::ACTION_DONE => self::STATUS_DONE,
        self::ACTION_REPLY => self::STATUS_ACTIVE
    ];

    public $status;
    public $workerId;
    public $clientId;

    public function __construct(string $status, ?int $workerId, int $clientId)
    {
        $this->setStatus($status);
        $this->workerId = $workerId;
        $this->clientId = $clientId;
    }

    public function setStatus($status)
    {
        $this->status = $status;
    }

    /**
     * Метод для возврата текущего статуса задачи statusAllowedActions
     *
     * @return void
     */
    public function statusAllowedActions()
    {
        return $this->status;
    }

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
    public function getAvailableActions($role, $userId)
    {
        $statusActions = $this->statusAllowedActions();

        $actions = self::ACTIONS_MAP[$statusActions];

        if (empty($actions)) {
            return [];
        }

        $roleActions = $actions[$role];
        $nextAction = new $roleActions();

        if ($nextAction->compareId($userId, $this->workerId, $this->clientId)) {
            return $roleActions;
        }
        return [];
    }
}
