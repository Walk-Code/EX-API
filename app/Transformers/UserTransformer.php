<?php

namespace App\Transformers;

use App\Models\User;
use League\Fractal\TransformerAbstract;

/**
 * 用户信息结果处理类
 * Class UserTransformer
 * @package App\Transformers
 */
class UserTransformer extends TransformerAbstract {

    protected $authorization;

    public function transform(User $user) {

        return [
            'id' => $user->id,
            'email' => $user->email,
            'name' => $user->name,
            'avatar' => $user->avatar,
            'created_at' => $user->created_at->toDateTimeString(),
            'updated_at' => $user->updated_at->toDateTimeString(),
        ];
    }

}