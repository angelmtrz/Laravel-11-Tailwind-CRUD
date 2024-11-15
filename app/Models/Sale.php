<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sale extends Model
{
    use HasFactory;

    protected $fillable = [
        'emission_date',
        'customer_id',
        'items',
        'total'
    ];

    protected function casts()
    {
        return [
            'emission_date' => 'datetime',
        ];
    }

    //Relacion muchos a 1 con Customers
    public function customer()
    {
        return $this->belongsTo(Customer::class);
    }
}
