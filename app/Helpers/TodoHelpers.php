<?php

use App\Models\Todo;

if (!function_exists('isTodoCreator')) {
    function isTodoCreator(Todo $todo) : bool
    {
        return $todo->user_id === auth()->id();
    }
}
