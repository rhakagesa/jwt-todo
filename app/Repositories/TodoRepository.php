<?php

namespace App\Repositories;

use App\Models\Todo;

class TodoRepository{
    protected $tasks;

    public function __construct(Todo $tasks)
    {
        $this->tasks = $tasks;
    }

    public function getAll() : Object
    {
        $tasks = $this->tasks->all();
        return $tasks;
    }

    public function getById(string $id) : Object 
    {
        $tasks = $this->tasks->find(['_id' => $id]);
        return $tasks;
    }

}