<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Services\AuthService;
use Exception;

class AuthController extends Controller
{
    /**
     * Create a new AuthController instance.
     *
     * @return void
     */
    public function __construct(AuthService $authService)
    {
        $this->middleware('auth:api', ['except' => ['login', 'register']]);
        $this->authService = $authService;
    }

    public function register(Request $request)
    {
        $data = $request->only('name', 'email', 'password');

        try{
            $this->authService->register($data);
            $result = [
                'status' => Response::HTTP_CREATED,
                'message' => 'register success.',
            ];
        } catch (Exception $e) {
            $result = [
                'status' => Response::HTTP_INTERNAL_SERVER_ERROR,
                'error' => $e->getMessage()
            ];
        }

        return response()->json($result);
    }

    /**
     * Get a JWT via given credentials.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function login()
    {
        $credentials = request(['email', 'password']);
    
        try{
            $result = [
                'status' => Response::HTTP_OK,
                'data' => [
                    'access_token' => $this->authService->login($credentials),
                    'token_type' => 'bearer',
                    'expires_in' => auth()->factory()->getTTL() * 60
                ],
                'message' => 'success'
            ];
        } catch (Exception $e) {
            $result = [
                'status' => Response::HTTP_UNAUTHORIZED,
                'error' => 'Unauthorized. '.$e->getMessage()
            ];
        }

        return response()->json($result);
    }

    /**
     * Get the authenticated User.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function me()
    {
        try{
            $result = [
                'status' => Response::HTTP_OK,
                'data' => $this->authService->getInfo(),
                'message' => 'success'
            ];
        } catch (Exception $e) {
            $result = [
                'status' => Response::HTTP_INTERNAL_SERVER_ERROR,
                'error' => $e->getMessage()
            ];
        }

        return response()->json($result);
    }

       /**
     * Refresh a token.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function refresh()
    {
        try{
            $token = $this->authService->refresh();
            $result = [
                'status' => Response::HTTP_OK,
                'data' => [
                    'access_token' => $token,
                    'token_type' => 'bearer',
                    'expires_in' => auth()->factory()->getTTL() * 60
                ],
                'message' => 'success'
            ];
        } catch (Exception $e) {
            $result = [
                'status' => Response::HTTP_INTERNAL_SERVER_ERROR,
                'error' => $e->getMessage()
            ];
        }

        return response()->json([$result]);
    }

    /**
     * Log the user out (Invalidate the token).
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function logout()
    {
        try{
            $this->authService->logout();
            $result = [
                'status' => Response::HTTP_OK,
                'message' => 'logout success.'
            ];
        } catch (Exception $e) {
            $result = [
                'status' => Response::HTTP_INTERNAL_SERVER_ERROR,
                'error' => $e->getMessage()
            ];
        }
        return response()->json($result);
    }

    public function updateUser(Request $request)
    {
        $data = $request->only('_id', 'name', 'email', 'password');

        try{
            $this->authService->updateUser($data);
            $result = [
                'status' => Response::HTTP_OK,
                'message' => 'user has been updated.',
            ];
        } catch (Exception $e) {
            $result = [
                'status' => Response::HTTP_INTERNAL_SERVER_ERROR,
                'error' => $e->getMessage()
            ];
        }

        return response()->json($result);
    }

    public function deleteUser(Request $request)
    {
        $data = $request->only('_id');

        try{
            $this->authService->removeUser($data);
            $result = [
                'status' => Response::HTTP_OK,
                'message' => 'user has been removed.',
            ];
        } catch (Exception $e) {
            $result = [
                'status' => Response::HTTP_INTERNAL_SERVER_ERROR,
                'error' => $e->getMessage()
            ];
        }

        return response()->json($result);
    }
}