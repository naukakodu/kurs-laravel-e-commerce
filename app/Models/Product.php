<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Product extends Model
{
    use HasFactory;

    protected $fillable = ['category_id', 'name', 'description', 'buy_price', 'discount_price', 'available_amount', 'is_visible'];

    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }
}
