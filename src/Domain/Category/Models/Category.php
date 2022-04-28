<?php

namespace Domain\Category\Models;

use Illuminate\Database\Eloquent\{Model, SoftDeletes};

class Category extends Model
{
    use SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'description',
        'is_active',
    ];
}
