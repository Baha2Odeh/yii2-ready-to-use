<?php

namespace common\models;

use Yii;
use yii\web\UploadedFile;

/**
 * This is the model class for table "{{%education}}".
 *
 * @property int $id
 * @property int $user_id
 * @property int $institution_id
 * @property string $type
 * @property string $description
 * @property string $date
 * @property int $media_id
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
 * @property Institution $institution
 * @property Media $media
 * @property User $user
 */
class Education extends \common\models\ActiveRecord
{
    /** @var UploadedFile */
    public $image;
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%education}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['institution_id'],'required'],
            [[ 'user_id', 'institution_id', 'media_id'], 'integer'],
            [['type'], 'string'],
//            [['date'], 'safe'],
            [['date'], 'date', 'format' => 'php:Y-m-d'],
            [['image'],'file','skipOnEmpty' => true,'extensions' => 'jpg,png,gif,mp4,wav','maxSize' => 1024 * 1024 * 10,'tooBig' => Yii::t('app','Max Size Is 10MB')],
            [['description'], 'string', 'max' => 255],
            [['institution_id'], 'exist', 'skipOnError' => true, 'targetClass' => Institution::className(), 'targetAttribute' => ['institution_id' => 'id']],
            [['media_id'], 'exist', 'skipOnError' => true, 'targetClass' => Media::className(), 'targetAttribute' => ['media_id' => 'id']],
            [['user_id'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['user_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'user_id' => Yii::t('app', 'User ID'),
            'institution_id' => Yii::t('app', 'Institution ID'),
            'type' => Yii::t('app', 'Type'),
            'description' => Yii::t('app', 'Description'),
            'date' => Yii::t('app', 'Date'),
            'media_id' => Yii::t('app', 'Media ID'),
            'created_at' => Yii::t('app', 'Created At'),
            'created_by' => Yii::t('app', 'Created By'),
            'updated_at' => Yii::t('app', 'Updated At'),
            'updated_by' => Yii::t('app', 'Updated By'),
            'is_deleted' => Yii::t('app', 'Is Deleted'),
            'deleted_at' => Yii::t('app', 'Deleted At'),
            'deleted_by' => Yii::t('app', 'Deleted By'),
            'ip_address' => Yii::t('app', 'Ip Address'),
            'user_agent' => Yii::t('app', 'User Agent'),
            'image' => Yii::t('app', 'Image'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getInstitution()
    {
        return $this->hasOne(Institution::className(), ['id' => 'institution_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getMedia()
    {
        return $this->hasOne(Media::className(), ['id' => 'media_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(User::className(), ['id' => 'user_id']);
    }
}
