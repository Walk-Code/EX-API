<?php

namespace App\Http\Controllers\Api\V1;


use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Validator;


class AuthController extends BaseController {

    /**
     * 创建一个新的实例
     *
     * @return void
     */
    public function __construct() {
        $this->middleware('auth:api', ['except' => ['login']]);
    }

    /**
     * 通过给定的凭据获取JWT
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function login(Request $request) {

        $message = [
            'login.require' => '用户名或者邮箱未填写',
            'password.requrie' => '用户名密码未填写',
            'password.min' => '密码长度必须大于6位'
        ];

        $validator = Validator::make($request->all(),[
            'login' => 'require',
            'password' => 'require|min:6'
        ],$message);

        if ($validator->fails()) {
            $this->errorBadRequest($validator);
        }

        $field = filter_var($request->input('login'),FILTER_VALIDATE_EMAIL) ? 'email' : 'name';

        $request->merge([$field => $request->input('login')]);

        $credentials = $request->only([$field,'password']);

        if (!$token = Auth::attempt($credentials)) {
            return $this->response()->errorUnauthorized();
        }


    }

}