<?php

namespace common\traits;

use yii\db\ActiveQuery;
use yii\db\Expression;

/**
 * Trait SafeDeletedTrait
 * @package common\traits
 */
trait SafeDeletedTrait
{
    /**
     * {@inheritdoc}
     * @return ActiveQuery the newly created [[ActiveQuery]] instance.
     */
    public static function find()
    {
        return parent::find()->andOnCondition([static::tableName() . '.is_deleted' => 0]);
    }

    /**
     * @param bool $forceDelete
     * @return bool|false|int
     * @throws \Throwable
     * @throws \yii\db\StaleObjectException
     */
    public function delete($forceDelete = false)
    {
        if (parent::beforeDelete()) {
            if (!$forceDelete && $this->hasProperty('is_deleted')) {
                $this->is_deleted = 1;
                if ($this->hasProperty('deleted_at')) {
                  $this->deleted_at = new Expression('NOW()');
                }
                if ($this->hasProperty('deleted_by')) {
                  $this->deleted_by = (!empty(\Yii::$app->user) && !\Yii::$app->user->isGuest) ?  \Yii::$app->user->id : null;
                }
                $result = $this->save(false);
                return $result;
            }
            return parent::delete();
        }

        return false;
    }
}