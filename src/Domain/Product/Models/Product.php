<?php

namespace Domain\Product\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'description',
        'category_id',
        'dimensions',
        'code',
        'reference',
        'quantity_stock',
        'price',
        'is_active',
    ];
}
