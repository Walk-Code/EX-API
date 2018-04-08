<?php

namespace App\Http\Controllers\Api\V1;


use App\Models\Authorization;
use App\Serializer\ResponseSerializer;
use App\Transformers\AuthorizationTransformer;
use App\Transformers\NoContentTransformer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;


class AuthController extends BaseController {

    /**
     * 过滤
     *
     * @return void
     */
   /* public function __construct() {
        $this->middleware('auth:api', ['except' => ['login']]);
    }*/

    /**
     * @api {post} /login 创建一个token（create a token)
     * @apiDescription 创建一个token (create a token)
     * @apiGroup Auth
     * @apiPermission none
     * @apiParam {String} login 昵称或者邮箱
     * @apiParam {String} password 密码
     * @apiVersion 0.1.0
     * @apiSuccessExample {json} Success-Response:
     *     Http/1.1 201 Created
     *     {
     *          "message": "success",
     *          "data": {
     *              "token": "eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJpc3MiOiJodHRwOi8vd3d3LmFwaWFwcC5jb20vYXBpL2xvZ2luIiwiaWF0IjoxNTIzMDE4NTU2LCJleHAiOjE1MjMwMjIxNTYsIm5iZiI6MTUyMzAxODU1NiwianRpIjoiQmxQY0Z0YTMyWTU1Y0RTdSIsInN1YiI6MzgsInBydiI6IjIzYmQ1Yzg5NDlmNjAwYWRiMzllNzAxYzQwMDg3MmRiN2E1OTc2ZjcifQ.lyWWygX31DyZOg3pIqgjdhWjwqyxd1tN3XcUjS6tGpc",
     *              "expired_at": "2018-04-06 13:42:36",
     *              "refresh_expired_at": "2018-04-20 12:42:36"
     *          },
     *          "status_code": 200
     *     }
     * @apiErrorExample {json} Error-Response:
     *      Http/1.1 401 Unauthorized
     *      {
     *          "message": "Unauthorized",
     *          "status_code": 401
     *      }
     *
     */
    public function login(Request $request) {

        $message = [
            'login.required' => '用户名或者邮箱未填写',
            'password.required' => '用户名密码未填写',
            'password.min' => '密码长度必须大于6位'
        ];

        $validator = Validator::make($request->all(), [
            'login' => 'required',
            'password' => 'required|min:6'
        ], $message);

        if ($validator->fails()) {
            return $this->errorBadRequest($validator);
        }

        $field = filter_var($request->input('login'), FILTER_VALIDATE_EMAIL) ? 'email' : 'name';

        $request->merge([$field => $request->input('login')]);

        $credentials = $request->only([$field, 'password']);

        if (!$token = Auth::attempt($credentials)) {
            $this->response->errorUnauthorized();
        }

        $authorization = new Authorization($token);

        return $this->response->item($authorization, new AuthorizationTransformer(), function ($resource, $fractal) {
            $fractal->setSerializer(new ResponseSerializer());
        })->setStatusCode(201);

    }

    /**
     * @api {put} /auth/refresh 刷新token（refresh token）
     * @apiDescription 刷新jwt-token （refresh token）
     * @apiGroup Auth
     * @apiPermission JWT
     * @apiVersion 0.1.0
     * @apiHeader {String} Authorization 用户旧的token，value已Bearer开头
     * @apiSuccessExample {json} Success-Response:
     *     Http/1.1 200 Ok
     *     {
     *          "message": "success",
                "data": {
                    "token": "eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJpc3MiOiJodHRwOi8vd3d3LmFwaWFwcC5jb20vYXBpL3JlZnJlc2giLCJpYXQiOjE1MjMxOTQ2NzgsImV4cCI6MTUyMzE5ODI5OSwibmJmIjoxNTIzMTk0Njk5LCJqdGkiOiJJV24zaDRJNGpwMzhFS2FJIiwic3ViIjozOCwicHJ2IjoiMjNiZDVjODk0OWY2MDBhZGIzOWU3MDFjNDAwODcyZGI3YTU5NzZmNyJ9.XvXqVYQeKh9v2aMXGUlrgScOr1sOQb0P-0nwJyC7qaY",
                    "expired_at": "2018-04-08 14:38:19",
                    "refresh_expired_at": "2018-04-22 13:37:58"
                },
                "status_code": 200
     *     }
     *
     *
     * @apiErrorExample {json} Error-Response:
     *      Http/1.1 500 Internal Server Error
     *      {
                "message": "The token has been blacklisted",
                "status_code": 500
     *
     *      }
     */

    public function refresh() {

        $authorization = new Authorization(Auth::refresh());

        return $this->response->item($authorization, new AuthorizationTransformer(), function ($resource, $fractal) {
            $fractal->setSerializer(new ResponseSerializer());
        });
    }

    /**
     * @api {delete} /auth/destory 删除当前token （delete current token）
     * @apiDescription 删除当前token (delete current token)
     * @apiGroup Auth
     * @apiPermission jwt
     * @apiVersion 0.1.0
     * @apiHeader {String} Authorization 用户当前的token,value已Bearer开头
     * @apiSuccessExample {json} Success-Response:
     *      Http/1.1 204 No Content
     *
     */
    public function destory() {

        Auth::logout();

        return $this->response->noContent();

    }



}