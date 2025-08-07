<?php
declare(strict_types=1);

class Task
{
    // модификатор констант поменяла на public только из-за тестов
    public const string STATUS_NEW = 'new';   // новое задание (заказчик)
    public const string STATUS_CANCEL = 'cancel';  // отменено, отменил заказчик
    public const string STATUS_ACTIVE = 'active';   // в работе, заказчик выбрал исполнителя, если откликнулись
    public const string STATUS_READY = 'ready';    // выполнено, принято заказчиком
    public const string STATUS_FAILED = 'failed';   // провалено, отказался исполнитель

    public const string ACTION_CANCEL = 'cancel';   // отменить (заказчик)
    public const string ACTION_RESPONSE = 'response';  // откликнуться (исполнитель)
    public const string ACTION_APPROVE_WORKER = 'approve_worker';   // выбрать(принять) исполнителя для задачи (заказчик)
    public const string ACTION_ACCEPT = 'accept';  // принять работу (заказчик)
    public const string ACTION_REJECT = 'reject';  // отказаться (исполнитель)

    public const array STATUS_TO_ACTIONS = [
        self::STATUS_NEW => [self::ACTION_CANCEL, self::ACTION_APPROVE_WORKER], //(cancel - для исполнителя, approve_worker - для заказчика, если откликнулись исполнители)
        self::STATUS_CANCEL => [],
        self::STATUS_ACTIVE => [self::ACTION_ACCEPT, self::ACTION_REJECT], //  (accept - для заказчика, reject - для исполнителя)
        self::STATUS_READY => [],
        self::STATUS_FAILED => [],

    ];
    private const array ACTION_TO_STATUS = [
        self::ACTION_CANCEL => self::STATUS_CANCEL,
        self::ACTION_RESPONSE => null,
        self::ACTION_APPROVE_WORKER => self::STATUS_ACTIVE,
        self::ACTION_ACCEPT => self::STATUS_READY,
        self::ACTION_REJECT => self::STATUS_FAILED,
    ];

    private const array STATUSES = [
        self::STATUS_NEW => 'новое',  // новое
        self::STATUS_CANCEL => 'отменено', // отменено, отменил заказчик
        self::STATUS_ACTIVE => 'в работе', // в работе
        self::STATUS_READY => 'выполнено',  // выполнено, принято заказчиком
        self::STATUS_FAILED => 'провалено', // провалено, отказался исполнитель
    ];
    private const array ACTIONS = [
        self::ACTION_CANCEL => 'отменить задание', // отменить (заказчик)
        self::ACTION_RESPONSE => 'откликнуться на задание', // откликнуться (исполнитель)
        self::ACTION_APPROVE_WORKER => 'выбрать исполнителя задания',  // ???? выбрать(принять) исполнителя для задачи (заказчик)
        self::ACTION_ACCEPT => 'принять задание', // принять работу (заказчик)
        self::ACTION_REJECT => 'отказаться от задания', // отказаться (исполнитель)
    ];

    private int $ownerId;
    private ?int $workerId;
    private string $action;
    private string $status = self::STATUS_NEW;

    public function __construct(int $idOwner, ?int $idWorker)
    {
        $this->ownerId = $idOwner;
        $this->workerId = $idWorker;
    }

    /**
     * Метод для возврата статуса, в который перейдет задача для указанного действия
     *
     * @param string $action действие над задачей
     * @return ?string возвращает статус задачи
     */
    public function getNextStatus(string $action): ?string
    {
        return array_key_exists($action, self::ACTION_TO_STATUS) ? self::ACTION_TO_STATUS[$action] : null;
    }

    /**
     * Метод для получения доступных действий для указанного статуса, без учета роли пользователя(заказчик или исполнитель)
     *
     * @param string $status статус задачи
     * @return string[]|null возвращает возможные действия в виде массива строк // например ['cancel', 'approve_worker']
     */
    public function getActions(string $status): ?array
    {
        return array_key_exists($status,self::STATUS_TO_ACTIONS) ? self::STATUS_TO_ACTIONS[$status] : null;
    }
}