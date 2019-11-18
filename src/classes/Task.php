<?php

namespace TaskForce\classes;

class Task
{
    protected $dataTask = []; //array данные из базы данных

    public function getStatusTask()
    {
        return $this->dataTask['status'];
    }

    public function getWorkerId()
    {
        return $this->dataTask['worker_id'];
    }

    public function getCustomerId()
    {
        return $this->dataTask['customer_id'];
    }
}
