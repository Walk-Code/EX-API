<?php

namespace App\Transformers;


use App\Models\Authorization;
use League\Fractal\TransformerAbstract;

/**
 * 授权结果处理类
 * Class AuthorizationTransformer
 * @package App\Transformers
 */
class AuthorizationTransformer extends TransformerAbstract {

    public function transform(Authorization $authorization) {

        return [
            'token' => $authorization->getToken(),
            'expired_at' => $authorization->getExpiredAt(),
            'refresh_expired_at' => $authorization->getRefreshExpiredAt()
        ];

    }

}