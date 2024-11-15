<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'type',
        'document',
        'company_name',
        'address',
        'phone'
    ];

    //Relacion muchos a 1 con Users (inversa)
    public function user() {
        return $this->belongsTo(User::class);
    }

    //Relacion 1 a muchos con Sales
    public function sales() {
        return $this->hasMany(Sale::class);
    }
}
