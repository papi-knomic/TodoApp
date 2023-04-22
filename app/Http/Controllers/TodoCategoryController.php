<?php

namespace App\Http\Controllers;

use App\Http\Requests\AddTodoCategoryRequest;
use App\Http\Resources\TodoCategoryResource;
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
        $categories = auth()->user()->categories;
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
        if (!isCategoryCreator($todoCategory)) {
            return Response::errorResponse('You can not edit this category');
        }
        $fields = $request->validated();
        $todoCategory->update($fields);
        $todoCategory = new TodoCategoryResource($todoCategory);

        return Response::successResponseWithData($todoCategory, 'Category has been updated', 201);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param TodoCategory $todoCategory
     * @return JsonResponse
     */
    public function destroy(TodoCategory $todoCategory)
    {
        if (!isCategoryCreator($todoCategory)) {
            return Response::errorResponse('You can not delete this category');
        }

        if ($todoCategory->todos()->count()) {
            return Response::errorResponse('You can not delete this category because you have todos attached to it');
        }

        $todoCategory->delete();

        return Response::successResponse();
    }
}
