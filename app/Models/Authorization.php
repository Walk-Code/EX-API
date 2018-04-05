<?php
/**
 * Created by PhpStorm.
 * User: jianqi
 * Date: 2018/4/5
 * Time: 22:05
 */

namespace App\Models;


use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;

class Authorization {

    protected $token;

    protected $payload;

    /**
     * 创建一个实例
     * Authorization constructor.
     * @param string $token
     */
    public function __construct($token = "") {
        $this->token = $token;
    }

    /**
     * @return string
     * @throws \Exception
     */
    public function getToken() {

        if (!$this->token) {
            throw new \Exception('请设置token');
        }

        return $this->token;

    }

    /**
     * @param string $token
     * @return $this
     */
    public function setToken($token) {

        $this->token = $token;

        return $this;

    }

    /**
     * 获取payload对象
     * @return mixed
     */
    public function getPayload() {

        if (!$this->payload) {
            $this->payload = Auth::setToken($this->setToken())->getPayload();
        }

        return $this->payload;

    }


    /**
     * 获取过期时间
     * @return string
     */
    public function getExpiredAt() {

        return Carbon::createFromTimestamp($this->getPayload()->get('exp'))->toDateTimeString();

    }

    /**
     * 获取过期刷新时间
     * @return string
     */
    public function getRefreshExpiredAt() {

        return Carbon::createFromTimestamp($this->getPayload()->get('iat'))->addMinutes(config('jwt.refresh_ttl'))
            ->toDateTimeString();

    }

    /**
     * 通过token获取用户
     * @return mixed
     */
    public function user() {

        return Auth::authenticate($this->token);

    }

    public function toArray() {
        
    }
    
    
    
}