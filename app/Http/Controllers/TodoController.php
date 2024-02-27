<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\TodoService;
use Illuminate\Http\Response;
use Exception;

class TodoController extends Controller
{
    /**
     * Display a listing of the resource.
     */

    protected $todoService;

    public function __construct(TodoService $todoService)
    {
        $this->todoService = $todoService;        
    }

    /**
     * Display the specified resource.
     */
    public function showAll()
    {   
        try {
            $result = [
                'status' => Response::HTTP_OK,
                'data' => $this->todoService->getAll(),
                'message' => 'get all tasks success.'
            ];
        } catch (Exception $error) {
            $result = [
                'status' => Response::HTTP_INTERNAL_SERVER_ERROR,
                'message' => $error->getMessage()
            ];
        }

        
        return response()->json($result);
    }

    /**
     * Display the specified resource.
     */
    public function showById(string $id)
    {   
        try {
            $result = [
                'status' => Response::HTTP_OK,
                'data' => $this->todoService->getById($id),
                'message' => 'get tasks by id success.'
            ];

        } catch (Exception $error) {
            $result = [
                'status' => Response::HTTP_INTERNAL_SERVER_ERROR,
                'error' => $error->getMessage()
            ];
        }
        return response()->json($result);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function createTodo(Request $request)
    {
        $data = $request->only('task');
        try {
            $result = [
                'status' => Response::HTTP_CREATED,
                'data' => $this->todoService->create($data),
                'message' => 'create task success.'
            ];
        } catch (Exception $error) {
            $result = [
                'status' => Response::HTTP_INTERNAL_SERVER_ERROR,
                'error' => $error->getMessage()
            ];
        }
        return response()->json($result);

    }


    /**
     * Update the specified resource in storage.
     */
    public function updateTodo(Request $request, string $id)
    {
        $data = $request->only('task');
        try {

            $this->todoService->update($id, $data);

            $result = [
                'status' => Response::HTTP_OK,
                'data' => $this->todoService->getById($id),
                'message' => 'update task success.'
            ];
        } catch (Exception $error) {
            $result = [
                'status' => Response::HTTP_INTERNAL_SERVER_ERROR,
                'error' => $error->getMessage()
            ];
        }
        
        return response()->json($result); 
    }

    /**
     * Remove the specified resource from storage.
     */
    public function deleteTodo(string $id)
    {
        try {
            $result = [
                'status' => Response::HTTP_OK,
                'data' => null,
                'message' => 'delete task success.'
            ];
            $this->todoService->delete($id);
        } catch (Exception $error) {
            $result = [
                'status' => Response::HTTP_INTERNAL_SERVER_ERROR,
                'error' => $error->getMessage()
            ];
        }
        return response()->json($result);
    }

}
