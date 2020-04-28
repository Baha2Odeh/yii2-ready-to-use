<?php
/**
 * Yii bootstrap file.
 * Used for enhanced IDE code autocompletion.
 */
class Yii extends \yii\BaseYii
{
    /**
     * @var BaseApplication|WebApplication|ConsoleApplication the application instance
     */
    public static $app;
}

/**
 * Class BaseApplication
 * Used for properties that are identical for both WebApplication and ConsoleApplication
 * @property \common\components\User $user
 * @property \yii\mongodb\Connection $mongodb
 * @property  \yii\queue\redis\Queue $queue
 * @property \common\components\ImageCache $imageCache
 * @property  \yii\swiftmailer\Mailer $mailer


 */
abstract class BaseApplication extends yii\base\Application{}
class WebApplication extends yii\web\Application{}
class ConsoleApplication extends yii\console\Application{}