<?php

namespace App\Observers;

use App\Models\TodoCategory;

class TodoCategoryObserver
{
    /**
     * Handle the TodoCategory "created" event.
     *
     * @param TodoCategory $todoCategory
     * @return void
     */
    public function created(TodoCategory $todoCategory)
    {
        //
    }

    /**
     * Handle the TodoCategory "created" event.
     *
     * @param TodoCategory $todoCategory
     * @return void
     */
    public function creating(TodoCategory $todoCategory)
    {
        $this->setTodoCategoryName($todoCategory);
        $todoCategory->user_id = auth()->id();
    }

    /**
     * Handle the TodoCategory "updated" event.
     *
     * @param TodoCategory $todoCategory
     * @return void
     */
    public function updated(TodoCategory $todoCategory)
    {
        //
    }

    public function updating(TodoCategory $todoCategory)
    {
      $this->setTodoCategoryName($todoCategory);
    }

    /**
     * Handle the TodoCategory "deleted" event.
     *
     * @param TodoCategory $todoCategory
     * @return void
     */
    public function deleted(TodoCategory $todoCategory)
    {
        //
    }

    /**
     * Handle the TodoCategory "restored" event.
     *
     * @param TodoCategory $todoCategory
     * @return void
     */
    public function restored(TodoCategory $todoCategory)
    {
        //
    }

    /**
     * Handle the TodoCategory "force deleted" event.
     *
     * @param TodoCategory $todoCategory
     * @return void
     */
    public function forceDeleted(TodoCategory $todoCategory)
    {
        //
    }


    private function setTodoCategoryName( TodoCategory $todoCategory )
    {
        $title = strtolower( $todoCategory->title );
        $todoCategory->title = ucfirst( $title );
    }
}
