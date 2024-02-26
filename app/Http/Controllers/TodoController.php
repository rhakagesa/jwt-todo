<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\TodoService;
use Exception;
use Illuminate\Database\QueryException;
use Illuminate\Http\Response;
use Throwable;
use Whoops\Exception\ErrorException;

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
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
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
        } catch (QueryException $error) {
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

        } catch (QueryException $error) {
            $result = [
                'status' => Response::HTTP_INTERNAL_SERVER_ERROR,
                'error' => $error->getMessage()
            ];
        }
        return response()->json($result);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
