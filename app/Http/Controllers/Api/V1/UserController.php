<?php

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
     *        "email" : [
     *            "该邮箱已被他人注册"
     *        ]
     *    }
     *
     */
    public function create() {
        
    }


}