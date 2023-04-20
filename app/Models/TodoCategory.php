<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class TodoCategory extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    public function todos() : HasMany
    {
        return $this->hasMany(Todo::class);
    }
}
