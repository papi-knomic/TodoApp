<?php

namespace App\Observers;

use App\Models\TodoCategory;

class TodoCategoryObserver
{
    /**
     * Handle the TodoCategory "created" event.
     *
     * @param  \App\Models\TodoCategory  $todoCategory
     * @return void
     */
    public function created(TodoCategory $todoCategory)
    {
        //
    }

    /**
     * Handle the TodoCategory "updated" event.
     *
     * @param  \App\Models\TodoCategory  $todoCategory
     * @return void
     */
    public function updated(TodoCategory $todoCategory)
    {
        //
    }

    /**
     * Handle the TodoCategory "deleted" event.
     *
     * @param  \App\Models\TodoCategory  $todoCategory
     * @return void
     */
    public function deleted(TodoCategory $todoCategory)
    {
        //
    }

    /**
     * Handle the TodoCategory "restored" event.
     *
     * @param  \App\Models\TodoCategory  $todoCategory
     * @return void
     */
    public function restored(TodoCategory $todoCategory)
    {
        //
    }

    /**
     * Handle the TodoCategory "force deleted" event.
     *
     * @param  \App\Models\TodoCategory  $todoCategory
     * @return void
     */
    public function forceDeleted(TodoCategory $todoCategory)
    {
        //
    }
}
