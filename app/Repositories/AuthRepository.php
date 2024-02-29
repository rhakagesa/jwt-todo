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

    public function remove($id)
    {
        $user = $this->user->find($id)->delete();
        return $user;
    }

}