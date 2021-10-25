<?php
namespace common\components\helpers;

use Yii;
use Pheanstalk\Pheanstalk;
use Pheanstalk\PheanstalkInterface;
class BeanstalkHelpers {
    public static function put($data,$tube,$json_encode = true,$priority =  PheanstalkInterface::DEFAULT_PRIORITY, $delay = PheanstalkInterface::DEFAULT_DELAY){
	    $pheanstalk = new Pheanstalk( Yii::$app->params['BEANSTALK']['HOST'], Yii::$app->params['BEANSTALK']['PORT']);
        $pheanstalk->useTube($tube) ->put($json_encode? json_encode($data):$data,$priority,$delay);;

    }

}