<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;


    protected $fillable = [
        'customer_id',
        'product_id',
        'total_price',
        'order_type',
        'Quality',
        'is_completed',
    ];

    // Relationship: An order belongs to a customer
    public function customer()
    {
        return $this->belongsTo(Customer::class);
    }

    // Relationship: An order has many products
    public function product()
    {
        return $this->belongsTo(Product::class);
    }
}
