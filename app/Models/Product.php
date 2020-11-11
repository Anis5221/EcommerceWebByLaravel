<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'categorie_id',
        'product_name',
        'manufecture_id',
        'product_short_description',
        'product_long_description',
        'product_price',
        'product_image',
        'product_size',
        'product_color',
        'publication_status'

    ];

    public function order_detail()
    {
        return $this->hasMany('App\Models\Order_Detail');
    }
}
