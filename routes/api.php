<?php

$api = app('Dingo\Api\Routing\Router');

$api->version('v1', ['namespace' => 'App\Http\Controllers\Api\V1'], function ($api) {

    //$api->group(['prefix' => 'v1'],function ($api) {
    $api->post('registered', 'UserController@create');
    $api->get('user/{id}', ['as' => 'users.show', 'uses' => 'UserController@show']);
    //});

    $api->post('login', 'AuthController@login');
    $api->put('refresh', 'AuthController@refresh');
//JWT权限组
    $api->group(['middleware' => ['ex.refresh','api.auth']], function ($api) {

        $api->delete('auth/destory','AuthController@destory');
        $api->get('test', 'UserController@test');
    });


});