<?php
/**
 * Created by PhpStorm.
 * User: bahaa
 * Date: 11/20/18
 * Time: 6:17 PM
 */

namespace common\controllers;


use common\components\StringHelper;
use common\models\City;
use common\models\Institution;
use common\models\User;
use common\models\UserType;
use Yii;
use yii\helpers\ArrayHelper;
use yii\web\Response;

class HelperController extends Controller
{


    public function actionCity($country_id){
        $cites = City::find()
            ->select(['name'])
            ->andWhere(['country_id'=>$country_id])
            ->indexBy('id')
            ->column();
        return $this->asJson($cites);
    }
    public function actionInstitution($q = null, $id = null){
        $out = ['results' => ['id' => '', 'text' => '']];
        if (!is_null($q)) {
           $data =  Institution::find()->select(['id','name text'])
                ->andWhere(['like','name',$q])
                ->limit(20)
                ->asArray()
                ->all();
            $out['results'] = $data;
        }
        elseif ($id > 0) {
            $out['results'] = ['id' => $id, 'text' => !empty(Institution::find()->andWhere(['id'=>$id])->one()->name) ? Institution::find()->andWhere(['id'=>$id])->one()->name : ''];
        }
        return $this->asJson($out);
    }
    public function actionUser($q = null, $id = null){
        $user_type_id = Yii::$app->request->get('user_type_id',null);
        $out = ['results' => ['id' => '', 'text' => '']];
        if (!is_null($q)) {
            $data =  User::find()
                ->select(['user.id','CONCAT_WS(\' \',id,\'-\',first_name,last_name) text'])
                ->andFilterWhere(['user_type_id'=>$user_type_id])
                ->andWhere(['or',
                    ['like','CONCAT_WS(\' \',first_name,last_name)',$q],
                    ['=','user.id',$q]
                ])
                ->limit(20)
                ->asArray()
                ->all();
            $out['results'] = $data;
        }
        elseif ($id > 0) {
            $user = User::findOne(['id'=>$id]);
            $out['results'] = ['id' => $id, 'text' => !empty($user) ? $user->id.'-'.$user->username : ''];
        }
        return $this->asJson($out);
    }



}