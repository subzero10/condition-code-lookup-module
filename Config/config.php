<?php

$mysqlDBName = env('CCL_DB_DATABASE', env('DB_DATABASE', 'nothing'));

if ('nothing' === $mysqlDBName) {
    $mysqlDBName = snake_case(getenv('HEROKU_BRANCH'));
}

if (getenv('CI')) {
    $mysqlDBName = getenv('HEROKU_TEST_RUN_ID');
}

return [
    'name'  => 'ConditionCodeLookup',
    'cache' => [
        'enable'   => env('CCL_CACHE_ENABLE', false),
        'host'     => env('CCL_DB_HOST', env('DB_HOST', '127.0.0.1')),
        'port'     => env('CCL_DB_PORT', env('DB_PORT', '3306')),
        'database' => $mysqlDBName,
        'username' => env('CCL_DB_USERNAME', env('DB_USERNAME', 'forge')),
        'password' => env('CCL_DB_PASSWORD', env('DB_PASSWORD', '')),
    ],

];
