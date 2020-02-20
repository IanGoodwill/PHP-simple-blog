<?php
// connect to db
$connection = new mysqli(
    'localhost',
    'root',
    '',
    'simple_blog'
);
// handle error
if( $connection->error )  {
    echo 'CONNECTION ERROR:' . $connection->error;
    die;
} 

