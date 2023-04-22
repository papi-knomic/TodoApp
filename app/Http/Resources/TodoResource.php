<?php

namespace App\Http\Resources;

use App\Models\TodoCategory;
use Illuminate\Contracts\Support\Arrayable;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class TodoResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'title' => $this->title,
            'description' => $this->description,
            'deadline' => $this->deadline,
            'category' => $this->category ? new TodoCategory($this->category ) : null,
            'completed' => !$this->isOngoing,
            'created_at' => $this->created_at
        ];
    }
}
