<?php

namespace backend\modules\permissions;

/**
 * Permissions module definition class
 */
class Module extends \yii\base\Module
{
    /**
     * @inheritdoc
     */
    public $controllerNamespace = 'backend\modules\permissions\controllers';

    public $defaultRoute = 'assignment';
    /**
     * @inheritdoc
     */
    public function init()
    {
        parent::init();

        // custom initialization code goes here
    }
}
