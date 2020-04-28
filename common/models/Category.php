<?php

namespace common\models;

use common\behaviors\SluggableBehavior;
use Yii;
use yii\caching\TagDependency;
use yii\helpers\ArrayHelper;

/**
 * This is the model class for table "{{%category}}".
 *
 * @property int $id
 * @property string $slug
 * @property string $name
 * @property int $status
 * @property string $created_at
 * @property int $created_by
 * @property string $updated_at
 * @property int $updated_by
 * @property int $is_deleted
 * @property string $deleted_at
 * @property int $deleted_by
 * @property string $ip_address
 * @property string $user_agent
 *
 * @property Article[] $articles
 */
class Category extends \common\models\ActiveRecord
{

    const CACHE_KEY = 'cache:tag:category:list';
    public function behaviors()
    {
        return ArrayHelper::merge(parent::behaviors(), [
            'slug' => [
                'class' => SluggableBehavior::className(),
                'attribute' => ['name'],
                'slugAttribute' => 'slug',
                'ensureUnique' => true,
//                 'skipOnEmpty' => true
            ],

        ]);
    }
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%category}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name'], 'required'],
            [['is_active'], 'integer'],
            [['name'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'name' => Yii::t('app', 'Name'),
            'is_active' => Yii::t('app', 'Is Active'),
            'created_at' => Yii::t('app', 'Created At'),
            'created_by' => Yii::t('app', 'Created By'),
            'updated_at' => Yii::t('app', 'Updated At'),
            'updated_by' => Yii::t('app', 'Updated By'),
            'is_deleted' => Yii::t('app', 'Is Deleted'),
            'deleted_at' => Yii::t('app', 'Deleted At'),
            'deleted_by' => Yii::t('app', 'Deleted By'),
            'ip_address' => Yii::t('app', 'Ip Address'),
            'user_agent' => Yii::t('app', 'User Agent'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getArticles()
    {
        return $this->hasMany(Article::className(), ['category_id' => 'id']);
    }


    public function afterSave($insert, $changedAttributes)
    {
        parent::afterSave($insert, $changedAttributes); // TODO: Change the autogenerated stub

        TagDependency::invalidate(Yii::$app->cache,self::CACHE_KEY);
    }


    /**
     * @param bool $asArray
     * @return array|Country[]|\yii\db\ActiveRecord[]
     */
    public static function getCachedList($asArray=false){
        $list = self::find()->cache(0,new TagDependency(['tags' => self::CACHE_KEY]));
        if($asArray){
            $list->asArray();
        }
        return $list->all();
    }

    /**
     * @param string $language
     * @return array
     */
    public static function getNameList(){
        $list = self::getCachedList(true);
        return ArrayHelper::map($list,'id','name');
    }
}
