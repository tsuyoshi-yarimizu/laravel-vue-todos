<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\TodoCreateRequest;
use App\Http\Requests\TodoUpdateRequest;
use App\Models\Todo;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Auth;

class TodoController extends Controller
{
    public function index(): JsonResponse
    {
        $todos = Todo::where('user_id', Auth::id())->get();

        return response()->json([
            'todos' => $todos->toArray(),
        ]);
    }

    public function create(TodoCreateRequest $request): JsonResponse
    {
        $userId = Auth::id();
        $todo = (new Todo)->fill($request->all());
        $todo->user_id = $userId;
        $todo->save();

        return response()->json($todo);
    }

    public function update(TodoUpdateRequest $request, $id): JsonResponse
    {
        $todo = Todo::find($id);
        if (is_null($todo)) {
            $response = response()->json([
                'errors' => [
                    [
                        'message' => 'todo is not found.',
                    ],
                ],
            ], 404);
            throw new HttpResponseException($response);
        }

        $todo->fill($request->all());
        $todo->save();

        return response()->json($todo);
    }
}
