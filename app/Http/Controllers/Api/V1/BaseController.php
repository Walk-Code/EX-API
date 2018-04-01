<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use Dingo\Api\Exception\ValidationHttpException;
use Dingo\Api\Routing\Helpers;
use Illuminate\Validation\Validator;

class BaseController extends Controller {
    //dingo 接口调用
    use Helpers;

    protected function errorBadRequest(Validator $validator) {

        $result = [];
        $message = $validator->errors()->toArray();
/*
        if ($message) {
            foreach ($message as $field => $errors) {
                foreach ($errors as $error) {
                    $result [] = [
                        'field' => $field,
                        'code' => $error
                    ];
                }
            }
        }*/
        //echo json_encode($result);

        throw new ValidationHttpException($validator->errors(),null);

    }

}