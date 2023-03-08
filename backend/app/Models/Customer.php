<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'password',
        'age',
        'manager_name',
        'role_id'
    ];

    protected $hidden = [
        'password'
    ];
}
