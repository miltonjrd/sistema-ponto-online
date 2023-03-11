<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Model;
use PHPOpenSourceSaver\JWTAuth\Contracts\JWTSubject;

class Employee extends Authenticatable implements JWTSubject
{
    use HasFactory;

    protected $fillable = [
        'name',
        'password',
        'age',
        'manager_id',
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
