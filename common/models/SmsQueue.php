<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "sms_queue".
 *
 * @property int $id
 * @property string $sender_name
 * @property string $to_numbers
 * @property string $message
 * @property string $remote_address
 * @property string $http_x_forwarded_for
 * @property int $sent
 * @property string $sent_at
 * @property int $is_deleted
 * @property string $created_at
 * @property string $updated_at
 * @property int $created_by
 * @property int $updated_by
 * @property int $deleted_by
 */
class SmsQueue extends ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'sms_queue';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'sender_name' => Yii::t('app', 'Sender Name'),
            'to_numbers' => Yii::t('app', 'To Numbers'),
            'message' => Yii::t('app', 'Message'),
            'remote_address' => Yii::t('app', 'Remote Address'),
            'http_x_forwarded_for' => Yii::t('app', 'Http X Forwarded For'),
            'sent' => Yii::t('app', 'Sent'),
            'sent_at' => Yii::t('app', 'Sent At'),
            'is_deleted' => Yii::t('app', 'Is Deleted'),
            'created_at' => Yii::t('app', 'Created At'),
            'updated_at' => Yii::t('app', 'Updated At'),
            'created_by' => Yii::t('app', 'Created By'),
            'updated_by' => Yii::t('app', 'Updated By'),
            'deleted_by' => Yii::t('app', 'Deleted By'),
        ];
    }
}
