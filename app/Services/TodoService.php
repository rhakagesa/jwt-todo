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

        /**
     * Get all tasks.
     *
     * @return Object
     */
    public function getAll() : Object 
    {
        $tasks = $this->todoRepository->getAll();
        return $tasks;
    }

    /**
     * Get a task by its ID.
     *
     * @param string $id The ID of the task to retrieve
     * @return Object The task object
     */
    public function getById(string $id) : Object 
    {
        $tasks = $this->todoRepository->getById($id);
        return $tasks;
    }

    /**
     * Create data in the database.
     *
     * @param array $data The data to be stored
     * @return Object The stored data
     */
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

    /**
     * Update a record with the given ID and data.
     *
     * @param string $id The ID of the record to update
     * @param array $data The data to update the record with
     * @return Object The updated record
     */
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

    /**
     * Delete a task by its ID.
     *
     * @param string $id The ID of the task to delete
     * @return Object The deleted task
     */
    public function delete(string $id)
    {
        $tasks = $this->todoRepository->delete($id);
        return $tasks;
    }
}