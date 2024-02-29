<?php

namespace App\Services;

use App\Repositories\AuthRepository;
use Illuminate\Validation\ValidationException;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;
use Exception;

class AuthService
{

    protected $authRepository;
    public function __construct(AuthRepository $authRepository)
    {
        $this->authRepository = $authRepository;
    }

    public function register(array $data)
    {
        try{
            $validator = Validator::make($data, [
                'name' => 'required',
                'email' => 'required|email',
                'password' => 'required',
            ]);

            if ($validator->fails()) {
                throw new ValidationException($validator);
            }

            $user = $this->authRepository->register($data);
            return $user;

        } catch (ValidationException $e) {
            throw new ValidationException($e->validator);
        }
    }

    public function removeUser($id)
    {
        $user = $this->authRepository->remove($id);
        return $user;
    }

}