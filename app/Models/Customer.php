<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    use HasFactory;

    public $timestamps = false;


    protected $fillable = [
        'Customer_name',
        'Customer_address',
        'Customer_contact_no',
        'Customer_email',
    ];

    // Relationship: A web customer can place many orders
    public function orders()
    {
        return $this->hasMany(Order::class);
    }

    // Relationship: A web customer can make many reservations
    public function reservations()
    {
        return $this->hasMany(Reservation::class);
    }
}
