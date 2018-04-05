<?php


namespace App\Serializer;

use League\Fractal\Resource\Collection;
use League\Fractal\Serializer\ArraySerializer;

/** 重写响应处理类
 * Class ResponseSerializer
 * @package app\Serializer
 */
class ResponseSerializer extends ArraySerializer {

    /**
     *  重写序列化一个集合
     * @param Collection $resourceKey
     * @param array $data
     * @return array
     */
    public function collection($resourceKey, array $data) {

        return ['message' => 'success','data' => $data,'status_code' => 200];

    }

    /**
     * 重写序列化一个项目
     * @param string $resourceKey
     * @param array $data
     * @return array
     */
    public function item($resourceKey, array $data) {

        return ['message' => 'success','data' => $data,'status_code' => 200];

    }


}