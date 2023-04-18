<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;


class Product extends Model
{
    use HasFactory;
    protected $table = "product";
    protected $fillable = [
        'name', 'price', 'image_path', 'description', 'categories_id', 'quantity', 'status_id'
    ];

    /**
     * Get the user that owns the Product
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function categories(): BelongsTo
    {
        return $this->belongsTo('App\Models\Categories', 'categories_id', 'id');
    }

    /**
     * Get the user that owns the Product
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function product_status(): BelongsTo
    {
        return $this->belongsTo('App\Models\ProductStatus', 'product_status_id', 'id');
    }
}
