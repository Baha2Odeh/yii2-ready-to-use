<?php

namespace common\models;

use Yii;
use yii\caching\TagDependency;
use yii\helpers\ArrayHelper;

/**
 * This is the model class for table "{{%institution}}".
 *
 * @property int $id
 * @property string $name
 * @property string $alternative_names
 * @property string $type_id
 * @property int $country_id
 * @property string $ranking_id
 * @property int $ivy_league
 * @property int $global_rank
 * @property int $language_id
 * @property string $adder_type_id
 * @property string $sector
 * @property string $name_ar
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
 * @property Education[] $educations
 * @property Country $country
 */
class Institution extends \common\models\ActiveRecord
{

    const CACHE_KEY = 'cache:tag:institution:list';
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%institution}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name', 'alternative_names', 'country_id', 'name_ar'], 'required'],
            [['alternative_names', 'type_id', 'ranking_id', 'adder_type_id', 'sector'], 'string'],
            [['country_id', 'ivy_league', 'global_rank', 'language_id'], 'integer'],
            [['name', 'name_ar'], 'string', 'max' => 255],
            [['country_id'], 'exist', 'skipOnError' => true, 'targetClass' => Country::className(), 'targetAttribute' => ['country_id' => 'id']],
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
            'alternative_names' => Yii::t('app', 'Alternative Names'),
            'type_id' => Yii::t('app', 'Type ID'),
            'country_id' => Yii::t('app', 'Country ID'),
            'ranking_id' => Yii::t('app', 'Ranking ID'),
            'ivy_league' => Yii::t('app', 'Ivy League'),
            'global_rank' => Yii::t('app', 'Global Rank'),
            'language_id' => Yii::t('app', 'Language ID'),
            'adder_type_id' => Yii::t('app', 'Adder Type ID'),
            'sector' => Yii::t('app', 'Sector'),
            'name_ar' => Yii::t('app', 'Name Ar'),
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
    public function getEducations()
    {
        return $this->hasMany(Education::className(), ['institution_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCountry()
    {
        return $this->hasOne(Country::className(), ['id' => 'country_id']);
    }


    /**
     * @param bool $asArray
     * @return array|Education[]|\yii\db\ActiveRecord[]
     */
    public static function getCachedList($asArray=false){
        $list = self::find()->cache(0,new TagDependency(['tags' => self::CACHE_KEY]));
        if($asArray){
            $list->asArray();
        }
        return $list->limit(10)->all();
    }

    /**
     * @param string $language
     * @return array
     */
    public static function getInstitutionList($language='en'){
        $list = self::getCachedList(true);
        return ArrayHelper::map($list,'id',$language == 'en' ? 'name' : 'name_ar');
    }

}
