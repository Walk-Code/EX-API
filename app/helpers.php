<?php

namespace app;

//debug
use function foo\func;

if (!function_exists('dehub')) {
    function debug() {
        $numargs = func_num_args();
        $argList = func_get_args();
        for ($i = 0; $i < $numargs; $i++) {
            echo '第' . $i . '个变量的值为：' . $argList[$i] . '<br>';
        }
        echo '当前所处的文件名为：' . __FILE__ . '<br>';
    }
}

/**
 * 根据别名获得url.
 *
 * @param string $version
 * @param string $name
 * @param string $params
 *
 * @return string
 */

if (!function_exists('')) {
    function dingo_route($version, $name,$param = []) {

        return app('Dingo\Api\Routing\UrlGenerator')
               ->version($version)
               ->route($name,$param);
    }
}