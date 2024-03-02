<?php

namespace App\Services;

use App\Repositories\TodoRepository;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;

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

    public function create(array $data)
    {
        try {
            $validator = Validator::make($data, [
                'task' => 'required',
            ]);

            if ($validator->fails()) {
                throw new ValidationException($validator);
            }

            $tasks = $this->todoRepository->store($data);
            return $tasks;
        } catch (ValidationException $e) {
            throw new ValidationException($e->validator);
        }
    }

    public function update(string $id, array $data)
    {
        try {
            $validator = Validator::make($data, [
                'task' => 'required',
            ]);

            if ($validator->fails()) {
                throw new ValidationException($validator);
            }

            $tasks = $this->todoRepository->update($id, $data);
            return $tasks;
        } catch (ValidationException $e) {
            throw new ValidationException($e->validator);
        }
    }

    public function delete(string $id)
    {
        $tasks = $this->todoRepository->delete($id);
        return $tasks;
    }
}