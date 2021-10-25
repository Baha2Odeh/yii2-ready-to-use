<?php

namespace common\lib\i18nModule\models;

use common\lib\i18nModule\components\I18n;
use common\lib\i18nModule\Module;
use Yii;
use yii\base\InvalidConfigException;

/**
 * This is the model class for table "{{%message}}".
 *
 * @property integer $id
 * @property string $language
 * @property string $translation
 */
class Message extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        /** @var \common\lib\i18nModule\components\I18n $i18n */
        $i18n = Yii::$app->getI18n();
        if (!($i18n instanceof I18n)) {
            throw new InvalidConfigException(Module::t('I18n component have to be instance of common\lib\i18nModule\components\I18n'));
        }

        return $i18n->getMessageTable();
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['language'], 'required'],
            [['translation'], 'string'],
            [['language'], 'string', 'max' => 16],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Module::t('ID'),
            'language' => Module::t('Language'),
            'translation' => Module::t('Translation'),
        ];
    }
}
