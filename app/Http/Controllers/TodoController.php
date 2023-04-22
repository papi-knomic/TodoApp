<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateTodoRequest;
use App\Http\Requests\UpdateTodoRequest;
use App\Http\Resources\TodoResource;
use App\Models\Todo;
use App\Traits\Response;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class TodoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return JsonResponse
     */
    public function index()
    {
        $todos = auth()->user()->todos;
        $todos = TodoResource::collection($todos)->response()->getData(true);

        return Response::successResponseWithData($todos);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param CreateTodoRequest $request
     * @return JsonResponse
     */
    public function store(CreateTodoRequest $request) : JsonResponse
    {
        $fields = $request->validated();
        $todo = auth()->user()->todos()->create($fields);

        return Response::successResponseWithData($todo, 'success', 201);
    }

    /**
     * Display the specified resource.
     *
     * @param Todo $todo
     * @return JsonResponse
     */
    public function show(Todo $todo): JsonResponse
    {
        if (!isTodoCreator($todo)) {
            return Response::errorResponse('You can not view this todo');
        }
        $todo = new TodoResource($todo);
        return Response::successResponseWithData($todo, 'success', 201);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param UpdateTodoRequest $request
     * @param Todo $todo
     * @return JsonResponse
     */
    public function update(UpdateTodoRequest $request, Todo $todo): JsonResponse
    {
        $fields = $request->validated();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Todo $todo
     * @return JsonResponse
     */
    public function destroy(Todo $todo): JsonResponse
    {
        if (!isTodoCreator($todo)) {
            return Response::errorResponse('You can not delete this todo');
        }

        $todo->delete();

        return Response::successResponse();
    }

    public function markTodo( Todo $todo ): JsonResponse
    {
        if (!isTodoCreator($todo)) {
            return Response::errorResponse('You can not edit this todo');
        }

        if (!$todo->isOngoing) {
            return Response::errorResponse('Todo is already completed', 400);
        }

        $todo->update(['status'=>'completed']);

        $todo = new TodoResource($todo);

        return Response::successResponseWithData($todo, 'success', 201);
    }

    public function unmarkTodo( Todo $todo ): JsonResponse
    {
        if (!isTodoCreator($todo)) {
            return Response::errorResponse('You can not edit this todo');
        }

        if ($todo->isOngoing) {
            return Response::errorResponse('Todo is still ongoing', 400);
        }

        $todo->update(['status'=>'ongoing']);

        $todo = new TodoResource($todo);

        return Response::successResponseWithData($todo, 'success', 201);
    }
}
