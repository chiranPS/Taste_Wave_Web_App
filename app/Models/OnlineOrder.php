<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OnlineOrder extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_name',
        'user_email',
        'total_price',
        'phone_number',
        'delivery_method',
        'delivery_address',
        'order_items',
        'is_completed',
    ];

    protected $casts = [
        'order_items' => 'array',
    ];
}
