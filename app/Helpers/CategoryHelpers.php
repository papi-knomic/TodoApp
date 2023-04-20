<?php

use App\Models\TodoCategory;

if ( !function_exists('isCategoryCreator')) {
    function isCategoryCreator(TodoCategory $category) : bool
    {
        return $category->user_id === auth()->id();
    }
}
