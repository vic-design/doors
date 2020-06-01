<?php

return [
    'class' => 'yii\db\Connection',
    // 'dsn' => 'mysql:host=mysql102.1gb.ru;dbname=dveri-vsem',
    // 'username' => 'gb_dveri_vsem',
    // 'password' => '33aa43c6cnmz',
    'dsn' => 'mysql:host=localhost;dbname=doors',
    'username' => 'root',
    'password' => '',
    'charset' => 'utf8',

    // Schema cache options (for production environment)
    'enableSchemaCache' => true,
    'schemaCacheDuration' => 60,
    'schemaCache' => 'cache',
];
