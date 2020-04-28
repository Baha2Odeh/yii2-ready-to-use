<?php

namespace common\lib\i18nModule\models;

use common\lib\i18nModule\components\I18n;
use common\lib\i18nModule\Module;
use Yii;
use yii\base\InvalidConfigException;
use yii\base\Model;

/**
 * Form used to create source message items
 */
class SourceMessageForm extends Model
{
    public $message;
    public $category;

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['category', 'message'], 'required'],
            [['message'], 'string'],
            [['category'], 'string', 'max' => 32],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'category' => Module::t('Category'),
            'message' => Module::t('Message'),
        ];
    }

    /**
     * @return bool
     */
    public function save()
    {
        SourceMessage::create($this->category, $this->message);

        return true;
    }
}
