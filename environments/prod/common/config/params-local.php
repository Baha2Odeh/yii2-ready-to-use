<?php
return [
    'urls' => [
        'backend' => 'https://back.app.local/',
        'frontend' => 'https://app.local/',
        'api' => 'https://api.app.local/',
        'cdn' => 'https://app.local/cdn/',
    ],
    'ffmpeg' => '/usr/bin/ffmpeg',
    'BEANSTALK' => [
        'HOST'      		=> '127.0.0.1',
        'PORT'      		=> 11300,
        'TTR'         		=> 60,          // 1 minute
        'TUBES'				=> [
            'DEFAULT'			=> 'app_default',
            'MAIL_QUEUE'        => 'app_mail_queue',
            'SMS_QUEUE'         => 'app_sms_queue',
        ]
    ],
    'SMS'=>[
        'SENDER_NAME'=>'XXXX',
        'PROVIDERS'=>[
            'TWILIO'=>[
                'SID'=>'SIDSIDSIDSID',
                'TOKEN'=>'TOKENTOKENTOKEN',
                'SENDER' => '+00000000000',
            ]
        ]
    ],
];
