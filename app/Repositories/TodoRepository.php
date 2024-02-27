<?php

namespace App\Repositories;

use App\Models\Todo;

class TodoRepository{
    protected $tasks;

    public function __construct(Todo $tasks)
    {
        $this->tasks = $tasks;
    }

        /**
     * Retrieve all tasks from the object.
     *
     * @return Object
     */
    public function getAll() : Object
    {
        $tasks = $this->tasks->get();
        return $tasks;
    }

        /**
     * Retrieves a task by its ID.
     *
     * @param string $id The ID of the task to retrieve
     * @return Object The task object
     */
    public function getById(string $id) : Object 
    {
        $tasks = $this->tasks->findOrFail(['_id' => $id]);
        return $tasks;
    }

        /**
     * Create data in the database.
     *
     * @param array $data The data to be stored
     * @return Object The stored data
     */
    public function store(array $data)
    {
        $tasks = $this->tasks->create($data);
        return $tasks;
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
        $tasks = $this->tasks->where('_id', $id)->update($data);
        return $tasks;
    }

        /**
     * Delete a task by its ID.
     *
     * @param string $id The ID of the task to be deleted
     * @return Object The deleted task
     */
    public function delete(string $id)
    {
        $tasks = $this->tasks->where('_id', $id)->delete();
        return $tasks;
    }
}