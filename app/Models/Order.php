<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $fillable =[
        'customer_id',
        'shipping_id',
        'payment_id',
        'total_order',
        'order_status'
    ];

    public function order_detail()
    {
        return $this->hasMany('App\Models\Order_Detail');
    }
}
