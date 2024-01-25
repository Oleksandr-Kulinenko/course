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

function getAllMessages($connection): array
{
    $data = [];
    $sql = "SELECT * FROM messages";
    $result = $connection->query($sql);

    while($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
        $data[] = $row;
    }

    return $data;
}

function checkRegUser($connection,$email,$pass){
    $data = [];
    $sql = "SELECT u.id,u.username,u.email,gu.role FROM users u INNER JOIN group_user gu ON u.group_user_id=gu.id where u.email='".$email."' and u.password='".$pass."'";

    $result = $connection->query($sql);
    if($result->num_rows != 0){
        $data = mysqli_fetch_array($result, MYSQLI_ASSOC);
    }

    return $data;
}

function addMessage($connection, $name, $message, $user_id)
{
    $current_time_zone = date_default_timezone_get();
    if ($current_time_zone != 'Europe/Kiev') {
        date_default_timezone_set('Europe/Kiev');
    }
    $current_datetime = date('Y-m-d H:i:s');
    $sql = "INSERT INTO messages (user_id,name,message,date_added) VALUES ($user_id,'".$name."','".$message."','".$current_datetime."')";
    if (!mysqli_query($connection, $sql)) {
        return false;
    }else{
        return true;
    }
}

function deleteMessage($connection , $id)
{
    $sql = "DELETE FROM messages WHERE id=". $id;

    if (!mysqli_query($connection, $sql)) {
        return false;
    }else{
        return true;
    }
}
