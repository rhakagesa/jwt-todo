<?php

namespace App\Repositories;

use App\Models\User;

class AuthRepository
{
    protected $user;

    public function __construct(User $user)
    {
        $this->user = $user;
    }

    public function register(array $data)
    {
        $user = $this->user->create($data);
        return $user;
    }

    public function update(array $data)
    {
        $user = $this->user->find($data['_id']);
        return $user->update($data);
    }

    public function remove(array $id)
    {
        $user = $this->user->find($id['_id']);
        return $user->delete();
    }

}