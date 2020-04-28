<?php

namespace common\traits;

trait EnumTrait
{
    public static function getEnumValues($attr, $translationCategoty = 'app')
    {
        preg_match('/\((.*)\)/', self::getTableSchema()->columns[$attr]->dbType, $matches);
        $values = [];
        foreach (explode(',', $matches[1]) as $value) {
            $value = str_replace("'", null, $value);
            $values[$value] = \Yii::t($translationCategoty, $value);
        }
        return $values;
    }
}