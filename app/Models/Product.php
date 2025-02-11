<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

 

    protected $fillable = [
        'product_name',
        'image',
        'product_price',
        'rating',
        'food_category',
        'description'
    ];

    // Relationship: A product belongs to many orders
    public function orders()
    {
        return $this->hasMany(Order::class);
    }

    // Relationship: A product can be managed by an employee
    public function manager()
    {
        return $this->belongsTo(Employee::class);
    }

    public function product()
{
    return $this->belongsTo(Product::class);
}
    
}
