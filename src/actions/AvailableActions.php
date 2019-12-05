<?php

namespace TaskForce\actions;

use TaskForce\ex\InputValues;
use TaskForce\ex\InputValuesException;

class AvailableActions
{
    const STATUS_NEW = 'new';
    const STATUS_CANCEL = 'cancel';
    const STATUS_DONE = 'done';
    const STATUS_FAIL = 'fail';
    const STATUS_ACTIVE = 'active';

    const LIST_STATUSES = [
        self::STATUS_NEW, self::STATUS_CANCEL, self::STATUS_DONE, self::STATUS_FAIL, self::STATUS_ACTIVE
    ];

    const ACTION_CANCEL = ActionCancel::class;
    const ACTION_REFUSE = ActionRefuse::class;
    const ACTION_DONE = ActionDone::class;
    const ACTION_REPLY = ActionReply::class;

    const LIST_ACTIONS = [
        self::ACTION_CANCEL, self::ACTION_REFUSE, self::ACTION_DONE, self::ACTION_REPLY
    ];

    const ROLE_CLIENT = 'client';
    const ROLE_WORKER = 'worker';

    const LIST_ROLES = [
        self::ROLE_CLIENT, self::ROLE_WORKER
    ];

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

    public function setStatus(string $status)
    {
        $this->status = $status;
        if (!in_array($this->status, self::LIST_STATUSES)) {
            throw new InputValuesException("Нет такого статуса или статус не найден!");
        }
    }

    /**
     * Метод для возврата статуса, в который перейдет задача для указанного действия
     * getNextStatus
     *
     * @param string $action название класса-действия
     *
     * @return string
     */
    public static function getNextStatus(string $action):string
    {
        if (!in_array($action, self::LIST_ACTIONS)) {
            throw new InputValuesException("Нет такого действия или действие не найдено!");
        }
        return self::ACTION_TO_STATUS[$action];
    }

    /**
     * Метод для получения списка доступных действий getAvailableActions
     *
     * @param string  $role   роль
     * @param integer $userId id пользователя
     *
     * @return array
     */
    public function getAvailableActions(string $role, int $userId):array
    {
        $availableActions[] = self::ACTIONS_MAP[$this->status][$role] ?? null;

        if (!in_array($role, self::LIST_ROLES)) {
            throw new InputValuesException("Нет такой роли или роль не найдена!");
        }

        $availableActions = array_filter($availableActions);
        return array_filter($availableActions, function ($className) use ($userId) {
            return $className::compareId($userId, $this->workerId, $this->clientId);
            }
        );
    }
}
