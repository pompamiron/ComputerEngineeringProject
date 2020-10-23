<?php
return [
    'propel' => [
        'database' => [
            'connections' => [
                'smart_cattle' => [
                    'adapter' => 'mysql',
                    'dsn' => 'mysql:host=localhost;port=3206;dbname=smart_cattle',
                    'user' => 'root',
                    'password' => '',
                    'settings' => [
                        'charset' => 'utf8'
                    ]
                ]
            ]
        ]
    ]
];
