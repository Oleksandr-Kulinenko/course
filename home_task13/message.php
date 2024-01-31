<?php
    require_once('database.php');

    $connection = getConnection();

    if(isset($_POST['name']) && isset($_POST['message']) && isset($_POST['user_id']) && isset($_POST['func']) && $_POST['func']=='addMessage'){
        if(!empty($_POST['message'])){
            $res = addMessage($connection,htmlspecialchars($_POST['name']),htmlspecialchars($_POST['message']),htmlspecialchars($_POST['user_id']));
            if($res){
                $json['success'] = 'Ваше повідомлення успішно додано!';
            }else{
                $json['error'] = 'Помилка додавання повідомлення, спробуйте знову!';
            }
        }else{
            $json['error'] = 'Помилка додавання повідомлення, спробуйте знову!';
        }


        header('Content-Type: application/json; charset=utf-8');
        echo json_encode($json);
    }

    if(isset($_POST['func']) && $_POST['func']=='getAllMessages'){
        $messages = getAllMessages($connection);
        $search = 'заборона';
        $count_search = iconv_strlen($search);
        $str_with_star = str_repeat("*", $count_search);

        for($i=0;$i<count($messages);$i++){
            preg_match('/.*\b(заборона)\b.*/iu', $messages[$i]['message'],$arr);
            if(!empty($arr)){
                $messages[$i]['message'] = str_ireplace($arr[1],$str_with_star,$arr[0]);
            }
        }

        header('Content-Type: application/json; charset=utf-8');
        echo json_encode(['data' => $messages]);
    }

    if(isset($_POST['func']) && $_POST['func']=='deleteMessage' && isset($_POST['message_id'])){
        $res_del = deleteMessage($connection,$_POST['message_id']);
        if($res_del){
            $json['success'] = 'Ваше повідомлення успішно видалено!';
        }else{
            $json['error'] = 'Помилка видалення повідомлення, спробуйте знову!';
        }
        header('Content-Type: application/json; charset=utf-8');
        echo json_encode($json);
    }
function getAllMessages($connection): array
{
    $data = [];
    $sql = "SELECT m.id,m.user_id,m.name,m.message,m.date_added,gu.role FROM messages m INNER JOIN users u ON m.user_id=u.id INNER JOIN group_user gu ON u.group_user_id=gu.id";
    $result = $connection->query($sql);

    while($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
        $data[] = $row;
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
