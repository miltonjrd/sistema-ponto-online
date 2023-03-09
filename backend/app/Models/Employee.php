<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use PHPOpenSourceSaver\JWTAuth\Contracts\JWTSubject;

class Employee extends Model implements JWTSubject
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
    
    /**
     * @return array;
     */
    public function getJWTCustomClaims(): array
    {
        return [];
    } 

    /**
     * @return mixed;
     */
    public function getJWTIdentifier(): mixed
    {
        return $this->getKey();
    }
}
