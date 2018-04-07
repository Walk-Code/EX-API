<?php
/**
 * Created by PhpStorm.
 * User: jianqi
 * Date: 2018/4/7
 * Time: 16:48
 */

namespace App\Http\Middleware;


use Closure;
use Symfony\Component\HttpKernel\Exception\UnauthorizedHttpException;
use Tymon\JWTAuth\Exceptions\JWTException;
use Tymon\JWTAuth\Exceptions\TokenExpiredException;
use Tymon\JWTAuth\Http\Middleware\BaseMiddleware;

/**
 * 重写刷新token中间件
 * Class RefreshToken
 * @package App\Http\Middleware
 */
class RefreshToken extends BaseMiddleware {

    /**
     * 处理需要刷新的token
     * @param $request
     * @param Closure $next
     * @return mixed
     */
    public function handle($request, Closure $next) {

        $this->checkForToken($request);

        try {
            //验证当前token
            if (!$this->auth->parseToken()->authenticate()) {
                return response('Unauthorized.', 401);
            }

            return $next($request);

        } catch (TokenExpiredException $exception) {

            //如果令牌已过期，则会刷新并添加到标头
            try {

                $refreshedToken = $this->auth->refresh();
                $this->auth->setToken($refreshedToken)->user();
                header('Authorization', 'Bearer ' . $refreshedToken);

            } catch (JWTException $e) {
                //无法刷新token
                throw new UnauthorizedHttpException('jwt-auth', $e->getMessage(), $e, $e->getCode());

            }

        } catch (JWTException $e) {

            throw new UnauthorizedHttpException('jwt-auth', $e->getMessage(), $e, $e->getCode());

        }

        $response = $next($request);

        return $this->setAuthenticationHeader($response, $refreshedToken);

    }


}