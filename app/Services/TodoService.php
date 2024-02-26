<?php

namespace App\Services;

use App\Repositories\TodoRepository;

class TodoService {
    protected $todoRepository;

    public function __construct(TodoRepository $todoRepository)
    {
        $this->todoRepository = $todoRepository;
    }

    public function getAll() : Object 
    {
        $tasks = $this->todoRepository->getAll();
        return $tasks;
    }

    public function getById(string $id) : Object 
    {
        $tasks = $this->todoRepository->getById($id);
        return $tasks;
    }


}