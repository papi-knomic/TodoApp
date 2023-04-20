<?php

use App\Models\Todo;

if ( !function_exists('isTodoCreator')) {
    function isCategoryCreator(Todo $todo) : bool
    {
        return $todo->user_id === auth()->id();
    }
}
