<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "{{%email_queue}}".
 *
 * @property int $id
 * @property string $from_address
 * @property string $to_address
 * @property string $cc_address
 * @property string $bcc_address
 * @property string $reply_to_address
 * @property string $subject
 * @property string $message
 * @property string $remote_address
 * @property string $http_x_forwarded_for
 * @property string $mail_content_type
 * @property string $mail_charset
 * @property string $return_path
 * @property int $priority
 * @property string $attachment_pathes
 * @property int $sent
 * @property string $sent_at
 * @property string $language_code
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
class EmailQueue extends \common\models\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%email_queue}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['message', 'attachment_pathes'], 'string'],
            [['priority', 'sent', 'created_by', 'updated_by', 'is_deleted', 'deleted_by'], 'integer'],
            [['sent_at', 'created_at', 'updated_at', 'deleted_at'], 'safe'],
            [['from_address', 'to_address', 'cc_address', 'bcc_address', 'reply_to_address', 'subject', 'remote_address', 'http_x_forwarded_for', 'mail_content_type', 'mail_charset', 'return_path', 'user_agent'], 'string', 'max' => 255],
            [['language_code'], 'string', 'max' => 5],
            [['ip_address'], 'string', 'max' => 40],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'from_address' => Yii::t('app', 'From Address'),
            'to_address' => Yii::t('app', 'To Address'),
            'cc_address' => Yii::t('app', 'Cc Address'),
            'bcc_address' => Yii::t('app', 'Bcc Address'),
            'reply_to_address' => Yii::t('app', 'Reply To Address'),
            'subject' => Yii::t('app', 'Subject'),
            'message' => Yii::t('app', 'Message'),
            'remote_address' => Yii::t('app', 'Remote Address'),
            'http_x_forwarded_for' => Yii::t('app', 'Http X Forwarded For'),
            'mail_content_type' => Yii::t('app', 'Mail Content Type'),
            'mail_charset' => Yii::t('app', 'Mail Charset'),
            'return_path' => Yii::t('app', 'Return Path'),
            'priority' => Yii::t('app', 'Priority'),
            'attachment_pathes' => Yii::t('app', 'Attachment Pathes'),
            'sent' => Yii::t('app', 'Sent'),
            'sent_at' => Yii::t('app', 'Sent At'),
            'language_code' => Yii::t('app', 'Language Code'),
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
