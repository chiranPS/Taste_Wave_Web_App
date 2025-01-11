<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Reservation extends Model
{
    use HasFactory;


    protected $fillable = [
        'branch_id',
        'table_no',
        'customer_contact_no',
        'customer_name',
        'is_completed',
        'date',
        'time',
    ];

    // Relationship: A reservation belongs to a branch
    public function branch()
    {
        return $this->belongsTo(Branch::class);
    }

    // Relationship: A reservation belongs to a customer
    public function customer()
    {
        return $this->belongsTo(Customer::class);
    }
}
