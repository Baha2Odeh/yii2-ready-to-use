<?php

namespace common\lib\i18nModule;

use common\lib\i18nModule\console\MessageController;
use yii\base\BootstrapInterface;

/**
 * Class Bootstrap
 * @package common\lib\i18nModule
 */
class Bootstrap implements BootstrapInterface
{
    /**
     * @inheritdoc
     */
    public function bootstrap($app)
    {
        if ($app instanceof \yii\console\Application) {
            if (!isset($app->controllerMap['message'])) {
                $app->controllerMap['message'] = MessageController::className();
            }
        }
    }
}
