<?php
/**
 * Created by PhpStorm.
 * User: jianqi
 * Date: 2018/4/1
 * Time: 16:54
 */

namespace App\Models;


use Illuminate\Database\Eloquent\Model;

class BaseModel extends Model {

    protected $guarded = ['id'];

    protected $hidden = ['deleted_at','extra'];
}