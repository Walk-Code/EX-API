<?php


namespace App\Transformers;


use League\Fractal\TransformerAbstract;

/**
 * 处理空返回值
 * Class NoContentTransformer
 * @package App\Transformers
 */
class NoContentTransformer extends TransformerAbstract {

    public function transform(\stdClass $stdClass) {

        return ['message' => '注销成功' , 'status_code' => 200];

    }
}