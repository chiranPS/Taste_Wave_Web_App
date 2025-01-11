<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{
    use HasFactory;


    protected $fillable = [
       'first_name',
        'last_name',
        'middle_name',
        'dob',
        'gender',
        'email',
        'phone',
        'address',
        'city',
        'start_date',
        'position'
    ];

    // Relationship: An employee manages many other employees
    public function managedEmployees(): HasMany
    {
        return $this->hasMany(Employee::class);
    }

    // Relationship: An employee can manage many products
    public function products(): HasMany
    {
        return $this->hasMany(Product::class);
    }

    // Relationship: An employee can be assigned to multiple deliveries
    public function deliveries(): HasMany
    {
        return $this->hasMany(Delivery::class);
    }
}
