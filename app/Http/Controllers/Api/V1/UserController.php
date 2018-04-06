<?php

namespace App\Http\Controllers\Api\V1;


use App\Models\User;
use App\Serializer\ResponseSerializer;
use App\Transformers\UserTransformer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use function app\dingo_route;


class UserController extends BaseController {

    /**
     * @api {post} /users 创建一个用户(create a user)
     * @apiDescription 创建一个用户(create a user)
     * @apiGroup user
     * @apiPermission none
     * @apiVersion 0.1.0
     * @apiParam {Email} email 邮箱必填
     * @apiParam {String} password 密码
     * @apiParam {String} name 昵称
     * @apiSuccessExample {json} Success-Response:
     *     Http/1.1 201 Created
     *     {
     *         "data": {
                "id": 26,
                "email": "312430882@qq.com",
                "name": "31243088",
                "avatar": null,
                "created_at": "2018-04-05 08:28:13",
                "updated_at": "2018-04-05 08:28:13"
                }
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

        $location = dingo_route('v1', 'users.show', $user->id);

       /* return $this->response->item($user, new UserTransformer())->set
            //->header('Accept','application/vnd.lumen.v1+json')//相应api 版本号
            ->header('Location', $location)
            ->setStatusCode(201,'注册成功，需要验证邮件')
            ->setMeta(['status_code' => 201,'message' => '注册成功，需要验证邮件']);*/
        return $this->response->item($user,new UserTransformer(),function ($resource, $fractal){
            $fractal->setSerializer(new ResponseSerializer());
        })->header('Location',$location)
            ->setStatusCode(201,'注册成功，需要验证邮件');


    }



}