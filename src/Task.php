<?php

namespace TaskForce;

class Task
{
    const STATUS_NEW = 'new';
    const STATUS_CANCEL = 'cancel';
    const STATUS_DONE = 'done';
    const STATUS_FAIL = 'fail';
    const STATUS_ACTIVE = 'active';

    const ACTION_CANCEL = 'cancel';
    const ACTION_REFUSE = 'refuse';
    const ACTION_EXECUTE = 'execute';
    const ACTION_REPLY = 'reply';

    const ACTIONS_MAP = [
        self::STATUS_NEW => [self::ACTION_CANCEL, self::ACTION_REPLY],
        self::STATUS_CANCEL => [],
        self::STATUS_DONE => [],
        self::STATUS_FAIL => [],
        self::STATUS_ACTIVE => [self::ACTION_REFUSE, self::ACTION_EXECUTE]
    ];

    const STATUS_MAP = [
        self::ACTION_CANCEL => [self::STATUS_CANCEL],
        self::ACTION_REFUSE => [self::STATUS_FAIL],
        self::ACTION_EXECUTE => [self::STATUS_DONE],
        self::ACTION_REPLY => [self::STATUS_ACTIVE]
    ];

    /**
     * Метод для возврата статуса, в который перейдет задача для указанного действия
     * getNextStatus
     *
     * @param string $action действие
     *
     * @return array
     */
    public function getNextStatus(string $action) : array
    {
        foreach (self::ACTIONS_MAP as $status) {
            if (in_array($action, $status)) {
                return $status;
            }
        } return null;
    }

    /**
     * Метод для возврата текущего статуса задачи для указанного действия
     * getCurrentStatus
     *
     * @param string $action действие
     *
     * @return void
     */
    public function getCurrentStatus(string $action)
    {
        return self::STATUS_MAP[$action];
    }
}
