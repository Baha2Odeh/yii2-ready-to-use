<?php
return [
    'name' => 'app',
    'aliases' => [
        '@bower' => '@vendor/bower-asset',
        '@npm'   => '@vendor/npm-asset',
    ],
    'vendorPath' => dirname(dirname(__DIR__)) . '/vendor',
    'bootstrap' => [
        'queue'
    ],
    'components' => [
        'assetManager' => [
            'appendTimestamp' => true,
        ],
        'cache' => [
            'class' => 'yii\caching\FileCache',
        ],
        'imageCache' => [
            'class' => '\common\components\imageCache',
        ],
        'i18n' => [
            'class' => '\common\lib\i18nModule\components\I18n',
            'messageSourceConfig' => [
                'class' => \yii\i18n\DbMessageSource::className(),
                'enableCaching' => true,
                'forceTranslation' => true,
            ],
            'handleMissing' => true,
            'only' => [
                'app',
                '*',
                'yii'
            ],
            'override' => true,
            'languages' => ['en', 'ar'],
        ],
        'authManager' => [
            'class' => 'yii\rbac\DbManager',
        ],
    ],
];
