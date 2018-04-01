<?php

namespace App\Models;

use Illuminate\Auth\Authenticatable;
use Illuminate\Contracts\Auth\Access\Authorizable as AuthorizableContract;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Database\Eloquent\SoftDeletes;
use Laravel\Lumen\Auth\Authorizable;

class User extends BaseModel implements AuthenticatableContract, AuthorizableContract
{
    use Authenticatable, Authorizable,SoftDeletes;

    //映射字段
    protected $fillable = [
        'name', 'email'
    ];

    //指的模型
    protected $table = 'users';

   //隐藏字段
    protected $hidden = [
        'password',
        'deleted_at'
    ];


}
