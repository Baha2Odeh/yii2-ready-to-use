<?php
/**
 * Created by PhpStorm.
 * User: bahaaodeh
 * Date: 11/23/18
 * Time: 11:57 PM
 */

namespace common\models;


use common\traits\EnumTrait;
use common\traits\SafeDeletedTrait;
use Yii;
use yii\behaviors\AttributeBehavior;
use yii\helpers\ArrayHelper;

class ActiveRecord extends \yii\db\ActiveRecord
{
    use EnumTrait;
    use SafeDeletedTrait;
    public function behaviors()
    {
        return [
            'CreatedByAndUpdatedByBehavior'=>[
                'class' => AttributeBehavior::className(),
                'attributes' => [
                    ActiveRecord::EVENT_BEFORE_INSERT => 'created_by',
                    ActiveRecord::EVENT_BEFORE_UPDATE => 'updated_by',
                ],
                'value' => function ($event) {
                    return (!empty(\Yii::$app->user) && !\Yii::$app->user->isGuest) ?  \Yii::$app->user->id : null;
                },
            ],
            'IpAddressBehavior'=>[
                'class' => AttributeBehavior::className(),
                'attributes' => [
                    ActiveRecord::EVENT_BEFORE_INSERT => 'ip_address',
                   // ActiveRecord::EVENT_BEFORE_UPDATE => 'ip_address',
                ],
                'value' => function ($event) {
                    return !empty(\Yii::$app->request) && !empty(\Yii::$app->request->userIP) ? \Yii::$app->request->userIP : null;
                },
            ],
            'UserAgentBehavior'=>[
                'class' => AttributeBehavior::className(),
                'attributes' => [
                    ActiveRecord::EVENT_BEFORE_INSERT => 'user_agent',
                    //ActiveRecord::EVENT_BEFORE_UPDATE => 'user_agent',
                ],
                'value' => function ($event) {
                    return !empty(\Yii::$app->request) && !empty(\Yii::$app->request->userAgent ) ? \Yii::$app->request->userAgent : null;
                },
            ],
        ];
    }

    /**
     * Creates and populates a set of models.
     *
     * @param string $modelClass
     * @param array $multipleModels
     * @param string $key
     * @return array
     * @throws \yii\base\InvalidConfigException
     */
    public static function createMultiple($modelClass, $multipleModels = [], $key = 'id')
    {
        /** @var ActiveRecord $model */
        $model = new $modelClass;
        $formName = $model->formName();
        $post = Yii::$app->request->post($formName);
        $models = [];

        if (!empty($multipleModels)) {
            $keys = array_keys(ArrayHelper::getColumn($multipleModels, $key, $key));
            $multipleModels = array_combine($keys, $multipleModels);
        }

        if ($post && is_array($post)) {
            foreach ($post as $i => $item) {
                if (isset($item[$key]) && !empty($item[$key]) && isset($multipleModels[$item[$key]])) {
                    $models[] = $multipleModels[$item[$key]];
                } else {
                    $models[] = new $modelClass;
                }
            }
        }

        unset($model, $formName, $post);

        return $models;
    }

}