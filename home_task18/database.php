<?php

function getConnection(): PDO
{
    $host = 'localhost';
    $username = 'root';
    $password = 'root';
    $dbName = 'simple_chat_loc';

    $connection = new PDO("mysql:host=$host;dbname=$dbName", $username, $password);
    $connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    return $connection;
}

function getAllMessages(PDO $connection): array
{
    $data = [];
    $sql = "SELECT * FROM messages";

    $query = $connection->query($sql);
    $query->setFetchMode(PDO::FETCH_ASSOC);

    while ($row = $query->fetch()) {
        $data[] = $row;
    }

    return $data;
}

function checkRegUser(PDO $connection,string $email, string $password){
    $data = [];
    $sql = "SELECT u.id,u.username,u.email,gu.role FROM users u INNER JOIN group_user gu ON u.group_user_id=gu.id where u.email=:email and u.password=:password";

    $query = $connection->prepare($sql);
    $params = compact('email', 'password');
    $result = $query->execute($params);
    if(!empty($result)){
        $data = $query->fetch(PDO::FETCH_ASSOC);
    }

    return $data;
}

function addMessage(PDO $connection, string $name, string $message, int $user_id)
{
    $current_time_zone = date_default_timezone_get();
    if ($current_time_zone != 'Europe/Kiev') {
        date_default_timezone_set('Europe/Kiev');
    }
    $current_datetime = date('Y-m-d H:i:s');
    $sql = "INSERT INTO messages (user_id,name,message,date_added) VALUES (:user_id,:name,:message,:date_added)";
    $query = $connection->prepare($sql);
    //$params = compact('user_id', 'name', 'message', 'date_added');
    //print_r($query);
    //exit;
    if (!$query->execute(['user_id' => $user_id,'name' => $name, 'message' => $message ,'date_added' => $current_datetime])) {
        return false;
    }else{
        return true;
    }
}

function deleteMessage($connection , $id)
{
    $sql = "DELETE FROM messages WHERE id=:id";
    $query = $connection->prepare($sql);

    if (!$query->execute(['id' => $id])) {
        return false;
    }else{
        return true;
    }
}
