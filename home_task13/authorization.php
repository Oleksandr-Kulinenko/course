<?php
    require_once('database.php');

    $connection = getConnection();

    if (!empty($_POST['email']) && !empty($_POST['pass'])) {
        $res = checkRegUser($connection, htmlspecialchars($_POST['email']), htmlspecialchars($_POST['pass']));

        if(!empty($res)){
            $json['success'] = 'Ви успішно авторизувались!';
            $json['user_id'] = $res['id'];
            $json['username'] = $res['username'];
            $json['type_user'] = $res['role'];

        }else{
            $json['error'] = 'Помилка! Невірний логін або пароль!';
        }

        header('Content-Type: application/json; charset=utf-8');
        echo json_encode($json);
    }

    if(!empty($_POST['user_id']) && !empty($_POST['func']) && $_POST['func']=='getRoleUser'){
        $user = getRoleUser($connection, htmlspecialchars($_POST['user_id']));
        print_r($user);
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


    function getRoleUser($connection,$user_id){
        $data = [];
        $sql = "SELECT u.id,u.username,gu.role FROM users u INNER JOIN group_user gu ON u.group_user_id=gu.id where u.id='".$user_id."'";

        $result = $connection->query($sql);
        if($result->num_rows != 0){
            $data = mysqli_fetch_array($result, MYSQLI_ASSOC);
        }

        header('Content-Type: application/json; charset=utf-8');
        echo json_encode($data);
    }
    mysqli_close($connection);
?>