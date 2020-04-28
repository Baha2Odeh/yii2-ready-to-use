<?php
namespace common\components\Notifications\Web;

use Yii;

class WebNotification {

    public function send($notificationInfo=[]){
        $model = new \common\models\WebNotification();
        $model->user_id = $notificationInfo['userId'];
        $model->text    = $notificationInfo['text'];
        $model->seen    = $notificationInfo['seen'];
        if(isset($notificationInfo['url'])){
            $model->url    = $notificationInfo['url'];
        }
        if(isset($notificationInfo['icon'])){
            $model->icon    = $notificationInfo['icon'];
        }
        $model->seen    = $notificationInfo['seen'];
        $model->save();
    }
}