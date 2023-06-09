<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\NotificationController;
use App\Http\Controllers\TodoCategoryController;
use App\Http\Controllers\TodoController;
use App\Models\TodoCategory;
use App\Traits\Response;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

//Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//    return $request->user();
//});

Route::group(['middleware' => ['json', 'throttle:60,1']], function () {
    Route::get('/', function () {
        return Response::successResponse('Welcome to {{insert_name}}');
    });

    //register
    Route::post('/register', [AuthController::class, 'register'])->name('register');
    //login
    Route::post('/login', [AuthController::class, 'login'])->name('login');

    Route::group(['middleware' => ['auth:sanctum']], function () {

        // Get categories
        Route::get('/categories', [TodoCategoryController::class, 'index']);

        Route::prefix('category')->group( function () {
            Route::post('/', [TodoCategoryController::class, 'store']);
            //update job type
            Route::put('/{todoCategory}', [TodoCategoryController::class, 'update']);
            //delete job type
            Route::delete('/{todoCategory}', [TodoCategoryController::class, 'destroy']);
        });

        Route::prefix('account')->group(function () {
            // Fetch profile
            Route::get('/profile', [AuthController::class, 'profile'])->name('profile');
            //update
            Route::post('/profile', [AuthController::class, 'update'])->name('profile.update');
        });

        Route::get('todos', [TodoController::class, 'index']);

        Route::prefix('todo')->group(function () {
            // get single
            Route::get('/{todo}', [TodoController::class, 'show']);
            // create todo
            Route::post('/', [TodoController::class, 'store']);
            // update todo
            Route::post('/{todo}', [TodoController::class, 'update']);
            //mark todo
            Route::post('/{todo}/mark', [TodoController::class, 'markTodo']);
            //unmark todo
            Route::post('/{todo}/unmark', [TodoController::class, 'unmarkTodo']);
            // delete todo
            Route::delete('/{todo}', [TodoController::class, 'destroy']);
        });

        Route::prefix('notifications')->group(function () {
            //Get user notifications
            Route::get('/', [NotificationController::class, 'index'])->name('notifications.index');
            // get unread notifications
            Route::get('/unread', [NotificationController::class, 'unread'])->name('notifications.unread');
            // get all read notifications
            Route::get('/read', [NotificationController::class, 'read'])->name('notifications.read');
            // mark all notifications
            Route::post('/', [NotificationController::class, 'markAll'])->name('notifications.markAll');
        });

        Route::prefix('notification')->group(function () {
            //show single notification
            Route::get('/{notification}', [NotificationController::class, 'show'])->name('notification.show');
            // mark single notification
            Route::post('/{notification}', [NotificationController::class,'mark'])->name('notification.mark');
        });

    });
});
