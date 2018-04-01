<?php

namespace App\Http\Controllers\Api\V1;


use function app\debug;
use function app\dingo_route;
use App\Models\User;
use App\Transformers\UserTransformer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;


class UserController extends BaseController {

    /**
     * @api {post} /users 创建一个用户(create a user)
     * @apiDescription 创建一个用户(create a user)
     * @apiGroup user
     * @apiPermission none
     * @apiVersion 0.1.0
     * @apiParam {Email} email email[unique]
     * @apiParam {String} password password
     * @apiParam {String} name name
     * @apiSuccessExample {json} Success-Response:
     *     Http/1.1 200 OK
     *     {
     *         token: eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJzdWIiOjEsImlzcyI6Imh0dHA6XC9cL21vYmlsZS5kZWZhcmEuY29tXC9hdXRoXC90b2tlbiIsImlhdCI6IjE0NDU0MjY0MTAiLCJleHAiOiIxNDQ1NjQyNDIxIiwibmJmIjoiMTQ0NTQyNjQyMSIsImp0aSI6Ijk3OTRjMTljYTk1NTdkNDQyYzBiMzk0ZjI2N2QzMTMxIn0.9UPMTxo3_PudxTWldsf4ag0PHq1rK8yO9e5vqdwRZLY
     *     }
     * @apiErrorExample {json} Error-Response:
     *    Http/1.1 400 Bad Request
     *    {
     *        "message": "422 Unprocessable Entity",
     *        "errors": {
     *            "password": [
     *                "密码长度必须大于6位"
     *             ]
     *         },
     *        "status_code": 422
     *    }
     *
     */
    public function create(Request $request) {

        $message = [
            'email.required' => '请填写邮箱地址',
            'email.unique' => '该邮箱已被注册',
            'email.email' => '请填写有效的邮件地址',
            'name.required' => '请填写昵称',
            'name.string' => '昵称为字符串',
            'name.alpha_dash' => '昵称只含有仅包含字母、数字、破折号（ - ）以及下划线（ _ ）',
            'password.required' => '密码不能为空',
            'password.min' => '密码长度必须大于6位',
        ];

        $validator = Validator::make($request->all(), [
            'email' => 'required|email|unique:users',
            'name' => 'required|alpha_dash|string',
            'password' => 'required|min:6',
        ], $message);


        if ($validator->fails()) {
            return $this->errorBadRequest($validator);
            //return response()->json($validator->errors());
        }

        $attr = [
            'email' => $request->input('email'),
            'name' => $request->input('name'),
            'password' => app('hash')->make($request->input('password'))

        ];

        $user = User::create($attr);

        // 用户注册成功后发送邮件
        //TODO 通过队列处理邮件发送

        $location = dingo_route('v1','users.show',$user->id);

        return $this->response->item($user,new UserTransformer())
            ->header('Location',$location)
            ->setStatusCode(201);


    }

    public function show($id) {
        
    }
    
    

}