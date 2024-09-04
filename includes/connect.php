<?php

$env = file(__DIR__ . '/../.env', FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);

foreach ($env as $value)
{

    $value = explode('=', $value);
    
    if($value[1] == 'false') $value[1] = false;
    elseif($value[1] == 'true') $value[1] = true;

    define($value[0], $value[1]);
    
}

$connect = mysqli_connect(
    DB_HOST,
    DB_USERNAME,
    DB_PASSWORD,
    DB_DATABASE
);