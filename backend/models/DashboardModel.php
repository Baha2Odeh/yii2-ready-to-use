<?php
/**
 * Created by PhpStorm.
 * User: bahaaodeh
 * Date: 12/7/18
 * Time: 2:38 PM
 */

namespace backend\models;




class DashboardModel extends Model
{

    const CACHE_KEY = 'DashboardModel:getDashboard';
    const CACHE_DURATION = 90000;

    public static function getDashboard($flushCache = false)
    {
        if ($flushCache) {
            $data = [];
        } else {
            $data = \Yii::$app->cache->get(self::CACHE_KEY);

        }
        if (empty($data)) {
            //@TODO write your dashboard data here
            \Yii::$app->cache->set(self::CACHE_KEY, $data,self::CACHE_DURATION);
        }


        return $data;
    }
}