<!DOCTYPE html>
<?php
    session_start();

    require_once('database.php');

    $connection = getConnection();

    if(!empty($_GET) && isset($_GET['logout']) && $_GET['logout']==1){
        $_SESSION['is_auth'] = false;
        if(isset($_SESSION['username']) && isset($_SESSION['type_user'])){
            unset($_SESSION['user_id']);
            unset($_SESSION['username']);
            unset($_SESSION['type_user']);
        }
        header('Location: index.php');
    }

    if ((!empty($_POST['email']) && !empty($_POST['pass']) && !isset($_POST['name']) && !isset($_POST['message'])) || (isset($_SESSION['is_auth']) && $_SESSION['is_auth']===true)) {
        if(!empty($_POST['email']) && !empty($_POST['pass'])){
            $res_check_user = checkRegUser($connection,$_POST['email'],$_POST['pass']);
            if(!empty($res_check_user)){
                $_SESSION['is_auth'] = true;
                $_SESSION['user_id'] = $res_check_user['id'];
                $_SESSION['username'] = $res_check_user['username'];
                $_SESSION['type_user'] = $res_check_user['role'];
            }else{
                $wrong_auth = true;
                $_SESSION['is_auth'] = false;
            }
        }else{
            if((!empty($_POST['message']) && empty($_GET['delete_message'])) || (!empty($_POST['message']) && !empty($_GET['delete_message']) && $_SESSION['type_user']=='admin')){
                $res_add = addMessage($connection, $_SESSION['username'],$_POST['message'],$_SESSION['user_id']);
                if($res_add){
                    $text_add_mess = 'Ваше повідомлення успішно додано!';
                }else{
                    $text_add_mess = 'Помилка додавання повідомлення! Спробуйте пізніше!';
                }
                $text_mess_del = false;
                $res_del_mess = false;
            }else{
                $res_add = false;
                $text_add_mess = 'Помилка додавання повідомлення! Дані пусті! Заповніть форму!';
                $text_mess_del = false;
                $res_del_mess = false;
            }
        }
    }else{
        $_SESSION['is_auth'] = false;
    }

    // Delete
    if (!empty($_GET['delete_message']) && isset($_SESSION['is_auth']) && $_SESSION['is_auth']===true) {
        $res_del_mess = deleteMessage($connection, $_GET['delete_message']);
        if($res_del_mess){
            $text_mess_del = 'Повідомлення успішно видалено!';
            $res_add = false;
            $text_add_mess = false;
        }else{
            $text_mess_del = 'Помилка видалення повідомлення!';
            $res_add = false;
            $text_add_mess = false;
        }
    }

    //Get all messages
    $messages = getAllMessages($connection);

    mysqli_close($connection);
?>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Bootstrap test</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
          integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"
            integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL"
            crossorigin="anonymous"></script>
    <script src="js/jquery-2.1.1.min.js" type="text/javascript"></script>
</head>
<body>
    <div class="container">
        <div id="result-add-mess">
            <?php if(isset($text_add_mess)){ ?>
                <?php if($res_add){ ?>
                    <div class="alert" role="alert" style="margin:10px 0;font-weight: bold;color:darkgreen;">
                        <?php echo $text_add_mess ?>
                    </div>
                <?php } else { ?>
                    <div class="alert" role="alert" style="margin:10px 0;font-weight: bold;color:red;">
                        <?php echo $text_add_mess ?>
                    </div>
                <?php } ?>
            <?php } ?>
        </div>
        <div id="result-del-mess">
            <?php if(isset($text_mess_del)){ ?>
                <?php if($res_del_mess){ ?>
                    <div class="alert" role="alert" style="margin:10px 0;font-weight: bold;color:darkgreen;">
                        <?php echo $text_mess_del ?>
                    </div>
                <?php } else { ?>
                    <div class="alert" role="alert" style="margin:10px 0;font-weight: bold;color:red;">
                        <?php echo $text_mess_del ?>
                    </div>
                <?php } ?>
            <?php } ?>
        </div>
        <?php if(isset($_SESSION['is_auth']) && $_SESSION['is_auth']===true){ ?>
            <div class="alert" role="alert" style="margin:10px 0;font-weight: bold;color:darkgreen;">
                <p style="float:left;width:95%"><img src="img/user_profile.png" height="42" width="42" style="margin-right:10px;"><span style="font-size:20px;color:black;"><?= $_SESSION['username'] ?></span></p>
                <a href="index.php?logout=1"><img src="img/exit.png" height="32" width="32" /></a>
            </div>
        <?php } ?>
        <div class="card" style="margin-top:10px;border:none;">
            <div class="col-sm-12">
                <div class="col-sm-8" style="margin-left:400px;"><img src="img/header_page_img.png" height="180" width="280"></div>
                <div class="col-sm-4" style="float:right;font-size: 28px;margin-top:-100px;margin-right: 150px;"><b>Simple Chat</b></div>
            </div>
        </div>
        <div style="clear:both;"></div>
        <div class="card" style="margin-top:20px;border:none;">
            <?php if(isset($_SESSION['type_user']) && $_SESSION['type_user']=='admin'){ ?>
                <?php $count = 1; foreach ($messages as $message) : ?>
                    <?php $remainder = $count % 2 ?>
                    <?php if($remainder != 0){ ?>
                        <div style="float:left;">
                            <img src="img/user_say.png" height="40" width="40" style="margin-right:10px;"><span style="font-size: 18px;margin-right: 10px;"><i><b><?= $message['name'] ?></b></i></span><i><?= $message['date_added'] ?></i>
                        </div>
                        <ul class="list-group list-group-flush" style="margin: 10px;position:relative;">
                            <li class="list-group-item" style="background-color: #F9F495;">
                                <i><?= $message['message'] ?></i><a href="?delete_message=<?= $message['id'] ?>"><img style="position: absolute;top: 10px;right: 15px;" src="img/delete.png" height="22" width="22"></a>
                            </li>
                        </ul>
                    <?php } else { ?>
                        <div style="float:left;">
                            <img src="img/user_say.png" height="40" width="40" style="margin-right:10px;"><span style="font-size: 18px;margin-right: 10px;"><i><b><?= $message['name'] ?></b></i></span><i><?= $message['date_added'] ?></i>
                        </div>
                        <ul class="list-group list-group-flush" style="margin: 10px;position:relative;">
                            <li class="list-group-item"  style="background-color: #FAD777;">
                                <i><?= $message['message'] ?></i><a href="?delete_message=<?= $message['id'] ?>"><img style="position: absolute;top:10px;right:15px;" src="img/delete.png" height="22" width="22"></a>
                            </li>
                        </ul>
                    <?php } ?>
                    <?php $count++; ?>
                <?php endforeach; ?>
            <?php } else { ?>
                <?php $count = 1; foreach ($messages as $message) : ?>
                    <?php $remainder = $count % 2 ?>
                    <?php if($remainder != 0){ ?>
                        <div style="float:left;">
                            <img src="img/user_say.png" height="40" width="40" style="margin-right:10px;"><span style="font-size: 18px;margin-right: 10px;"><i><b><?= $message['name'] ?></b></i></span><i><?= $message['date_added'] ?></i>
                        </div>
                        <ul class="list-group list-group-flush" style="margin: 10px;">
                            <li class="list-group-item" style="background-color: #F9F495;">
                                <i><?= $message['message'] ?></i>
                            </li>
                        </ul>
                    <?php } else { ?>
                        <div style="float:left;">
                            <img src="img/user_say.png" height="40" width="40" style="margin-right:10px;"><span style="font-size: 18px;margin-right: 10px;"><i><b><?= $message['name'] ?></b></i></span><i><?= $message['date_added'] ?></i>
                        </div>
                        <ul class="list-group list-group-flush" style="margin: 10px;">
                            <li class="list-group-item" style="background-color: #FAD777;">
                                <i><?= $message['message'] ?></i>
                            </li>
                        </ul>
                    <?php } ?>
                    <?php $count++; ?>
                <?php endforeach; ?>
            <?php } ?>
        </div>

        <br><br><br>
        <?php if(isset($_SESSION['is_auth']) && $_SESSION['is_auth']===true){ ?>
            <form method="post" id="message-form">
                <div style="clear:both;"></div>
                <div class="mb-3">
                    <label for="exampleInputMessage" class="form-label">Message will be sent by</label>
                    <input type="text" value="<?= $_SESSION['username'] ?>" class="form-control" name="name" disabled="disabled">
                </div>
                <div class="mb-3">
                    <label for="exampleInputMessage" class="form-label">Message</label>
                    <input type="text" class="form-control" name="message">
                </div>

                <button id="mess_send" type="button" class="btn btn-primary">Send Message</button>

            </form>
        <?php } else { ?>
            <form method="post" id="auth-form">
                <?php if(isset($wrong_auth) && $wrong_auth===true){ ?>
                    <div class="alert" role="alert" style="margin:10px 0;font-weight: bold;color:red;">
                        Невірний логін або пароль! Спробуйте знову!
                    </div>
                <?php } else { ?>
                    <div class="alert" role="alert" style="margin:10px 0;font-weight: bold;color:red;">
                        Для того щоб відправляти повідомлення авторизуйтесь нижче!
                    </div>
                <?php } ?>
                <div class="mb-3">
                    <label for="exampleInputEmail" class="form-label">Email</label>
                    <input type="text" class="form-control" name="email">
                </div>
                <div class="mb-3">
                    <label for="exampleInputPassword" class="form-label">Password</label>
                    <input type="password" class="form-control" name="pass">
                </div>

                <button id="auth" type="button" class="btn btn-primary">Log In</button>
            </form>
        <?php } ?>
    </div>
    <div style="margin-bottom: 50px;"></div>
    <script  type="text/javascript">
        $('#mess_send').click(function() {
            $("#message-form").submit();
        });

        $('#auth').click(function() {
            $("#auth-form").submit();
        });
    </script>
    </body>
</html>
