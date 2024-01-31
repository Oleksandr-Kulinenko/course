<?php
function getConnection()
{
    $host = 'localhost';
    $user = 'root';
    $password = 'root';
    $db_name = 'simple_chat_loc';

    $connection = mysqli_connect($host, $user, $password, $db_name);

    if ($connection->connect_error) {
        die("Connection failed " . $connection->connect_error);
    }

    return $connection;
}

