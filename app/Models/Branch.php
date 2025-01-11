<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Branch extends Model
{
    use HasFactory;


    protected $fillable = [
        'branch_location',
        'branch_tel_no',
        'City',
        'Road'
    ];

    // Relationship: A branch has many deliveries
    public function deliveries()
    {
        return $this->hasMany(Delivery::class);
    }

    // Relationship: A branch has many reservations
    public function reservations()
    {
        return $this->hasMany(Reservation::class);
    }
}

