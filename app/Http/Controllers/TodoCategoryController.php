<?php

namespace App\Http\Controllers;

use App\Http\Requests\AddTodoCategoryRequest;
use App\Http\Resources\JobResource;
use App\Http\Resources\TodoCategoryResource;
use App\Http\Resources\TodoResource;
use App\Models\TodoCategory;
use App\Traits\Response;
use Illuminate\Http\JsonResponse;

class TodoCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return JsonResponse
     */
    public function index() : JsonResponse
    {
        $categories = TodoCategory::all();
        $categories = TodoCategoryResource::collection($categories);
        return Response::successResponseWithData($categories);
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param AddTodoCategoryRequest $request
     * @return JsonResponse
     */
    public function store(AddTodoCategoryRequest $request) : JsonResponse
    {
        $fields = $request->validated();
        $category = TodoCategory::create($fields);
        $category = new TodoCategoryResource($category);

        return Response::successResponseWithData($category, 'Category has been added', 201);
    }


    /**
     * Update the specified resource in storage.
     *
     * @param AddTodoCategoryRequest $request
     * @param TodoCategory $todoCategory
     * @return JsonResponse
     */
    public function update(AddTodoCategoryRequest $request, TodoCategory $todoCategory) : JsonResponse
    {
        $fields = $request->validated();
        $category = $todoCategory->update($fields);
        $category = new TodoCategoryResource($category);

        return Response::successResponseWithData($category, 'Category has been added', 201);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param TodoCategory $todoCategory
     * @return JsonResponse
     */
    public function destroy(TodoCategory $todoCategory)
    {
        $todoCategory->delete();

        return Response::successResponse();
    }
}
