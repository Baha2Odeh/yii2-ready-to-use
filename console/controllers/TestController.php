<?php
/**
 * Created by PhpStorm.
 * User: bahaaodeh
 * Date: 11/24/18
 * Time: 12:39 AM
 */
namespace console\controllers;
use common\components\Helper;
use common\models\Media;
use common\models\User;
use Yii;

class TestController extends Controller
{

    public function actionTestMedia(){
        $media = Media::find()->where(['id'=>1])->one();
        $media->delete();
    }
    public function actionTestUser(){
        $user = User::find()->andWhere(['id'=>1])->andWhere('xas1=123')->one();
    }
    public function actionTestPhoneNumber(){
       echo Helper::formatMobileNumber('962788498698');
    }

    public function actionTestUserPhone(){
        $user = User::findOne(1);
        $user->phone_number = '+962 7884 986 98';
      echo   $user->validate('phone_number');
      echo $user->phone_number;
      echo PHP_EOL;
    }
    public function actionTestEmail(){
        $user = User::findOne(1);
        var_dump($user->password_reset_token);
        $x =  Yii::$app
            ->mailer
            ->compose(
                ['html' => 'passwordResetToken-html', 'text' => 'passwordResetToken-text'],
                ['user' => $user]
            )
            ->setFrom([Yii::$app->params['supportEmail'] => Yii::$app->name . ' robot'])
            ->setTo('bahaodehyousef@gmail.com')
            ->setSubject('Password reset for ' . Yii::$app->name)
            ->send();
        var_dump($x);
    }

}