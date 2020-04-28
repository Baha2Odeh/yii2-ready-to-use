<?php
/**
 * Created by PhpStorm.
 * User: bahaa
 * Date: 10/22/18
 * Time: 10:17 PM
 */

namespace common\behaviors;


use common\components\StringHelper;

class SluggableBehavior extends \yii\behaviors\SluggableBehavior
{

    public $words_limit = null;
    public $separator = '-';
    /**
     * @param array $slugParts
     * @return string
     */
    protected function generateSlug($slugParts)
    {
        return StringHelper::slug($slugParts,$this->separator,$this->words_limit);
    }
}