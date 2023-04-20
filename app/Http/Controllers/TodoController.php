<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateTodoRequest;
use App\Http\Resources\TodoResource;
use App\Models\Todo;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

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

        return \App\Traits\Response::successResponseWithData($todos);
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
    }

    /**
     * Display the specified resource.
     *
     * @param Todo $todo
     * @return Response
     */
    public function show(Todo $todo)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param Todo $todo
     * @return Response
     */
    public function update(Request $request, Todo $todo)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Todo $todo
     * @return Response
     */
    public function destroy(Todo $todo)
    {
        //
    }
}
