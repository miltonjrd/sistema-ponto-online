<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ClockedIn extends Model
{
    use HasFactory;

    protected $table = 'clocked_in';

    protected $fillable = [
        'customer_id'
    ];
}
