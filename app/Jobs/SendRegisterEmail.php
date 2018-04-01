<?php

namespace App\Jobs;
use App\Models\User;

/**
 * 用户注册成功发送邮件队列处理类
 * Class ExampleJob
 * @package App\Jobs
 */
class SendRegisterEmail extends Job {

    protected $user;

    public function __construct(User $user) {
         $this->user = $user;
    }

    /**
     * Execute the job.
     *
     * @return void
     *
     */
    public function handle() {

        $user = $this->user;

        //TODO 发送邮件到该邮箱

    }
}
