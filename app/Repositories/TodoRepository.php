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
        $tasks = $this->tasks->get();
        return $tasks;
    }

    public function getById(string $id) : Object 
    {
        $tasks = $this->tasks->findOrFail(['_id' => $id]);
        return $tasks;
    }

    public function store(array $data)
    {
        $tasks = $this->tasks->create($data);
        return $tasks;
    }

    public function update(string $id, array $data)
    {
        $tasks = $this->tasks->where('_id', $id)->update($data);
        return $tasks;
    }

    public function delete(string $id)
    {
        $tasks = $this->tasks->where('_id', $id)->delete();
        return $tasks;
    }
}