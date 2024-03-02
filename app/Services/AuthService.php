<?php

namespace App\Services;

use App\Repositories\AuthRepository;
use Illuminate\Validation\ValidationException;
use Illuminate\Support\Facades\Validator;

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
                'email' => 'required|email|unique:email',
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

    public function login(array $data)
    {
        try{
            $validator = Validator::make($data, [
                'email' => 'required|email',
                'password' => 'required',
            ]);

            $user = auth()->attempt($data);

            if ($validator->fails() || !$user) {
                throw new ValidationException($validator);
            } 
            else {
                return $user;                
            }
            
        } catch (ValidationException $e) {
            throw new ValidationException($e->validator);
        }
    }

    public function getInfo(){

        try{
            $user = auth()->user();
            if (!$user) {
                throw new ValidationException($user);
            }
            else{
                return $user;
            }

        } catch (ValidationException $e) {
            throw new ValidationException($e->validator);
        }
    }

    public function refresh()
    {
        try{
            $user = auth()->refresh();
            if (!$user) {
                throw new ValidationException($user);
            }
          
            return $user;
            
        } catch (ValidationException $e) {
            throw new ValidationException($e->validator);
        }
    }
    
    public function logout()
    {
        try{
            $user = auth()->logout();
            if (!!$user) {
                throw new ValidationException($user);
            }
      
            return $user;

        } catch (ValidationException $e) {
            throw new ValidationException($e->validator);
        }
    }

    public function updateUser(array $data)
    {
        try{
            $validator = Validator::make($data, ['_id' => 'required']);

            if ($validator->fails()) {
                throw new ValidationException($validator);
            }

            $user = $this->authRepository->update($data);
            return $user;

        } catch (ValidationException $e) {
            throw new ValidationException($e->validator);
        }
    }
    
    public function removeUser($data)
    {
        try{
            $validator = Validator::make($data, ['_id' => 'required']);

            if ($validator->fails()) {
                throw new ValidationException($validator);
            }

            $user = $this->authRepository->remove($data);
            return $user;

        } catch (ValidationException $e) {
            throw new ValidationException($e->validator);
        }
    }

}