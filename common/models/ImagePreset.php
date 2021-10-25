<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "{{%image_preset}}".
 *
 * @property int $id
 * @property string $name
 * @property int $width
 * @property int $height
 * @property string $created_at
 * @property int $created_by
 * @property string $updated_at
 * @property int $updated_by
 * @property int $is_deleted
 * @property string $deleted_at
 * @property int $deleted_by
 * @property string $ip_address
 * @property string $user_agent
 */
class ImagePreset extends \common\models\ActiveRecord
{

    CONST TYPE_THUMB = 'thumb';
    CONST TYPE_MEDIUM = 'medium';
    CONST TYPE_LARGE = 'large';
    CONST TYPE_COVER = 'cover';

    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%image_preset}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['width', 'height','name'], 'required'],
            [['name'],'unique'],
            [['width','height'],'unique','targetAttribute' => ['width','height']],
            [['width', 'height'], 'integer'],
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
            'width' => Yii::t('app', 'Width'),
            'height' => Yii::t('app', 'Height'),
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
}
