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

    const STATUS_MAP = [
        self::STATUS_NEW => [self::STATUS_CANCEL, self::STATUS_ACTIVE],
        self::STATUS_CANCEL => [],
        self::STATUS_DONE => [],
        self::STATUS_FAIL => [],
        self::STATUS_ACTIVE => [self::STATUS_DONE, self::STATUS_FAIL]
    ];

    const ACTION_TO_STATUS = [
        self::ACTION_CANCEL => self::STATUS_CANCEL,
        self::ACTION_REFUSE => self::STATUS_FAIL,
        self::ACTION_EXECUTE => self::STATUS_DONE,
        self::ACTION_REPLY => self::STATUS_ACTIVE
    ];

    /**
     * Метод для возврата статуса, в который перейдет задача для указанного действия
     * getNextStatus
     *
     * @param string $action действие
     *
     * @return string
     */
    public function getNextStatus(string $action)
    {
        return in_array($action, self::ACTION_TO_STATUS) ? self::ACTION_TO_STATUS[$action] : null;
    }

}
