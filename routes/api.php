<?php

$api = app('Dingo\Api\Routing\Router');

$api->version('v1', ['namespace' => 'App\Http\Controllers\Api\V1'], function ($api) {
    $api->get('test', function () {
        return 1;
    });

    //$api->group(['prefix' => 'v1'],function ($api) {
        $api->post('registered', 'UserController@create');
        $api->get('user/{id}', ['as' => 'users.show', 'uses' => 'UserController@show']);
    //});

    $api->post('login','AuthController@login');
//JWT权限组





});