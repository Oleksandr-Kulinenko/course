<!DOCTYPE html>

<?php
    session_start();
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
</head>
<body style="background-color:#F4F4F4;">
<div class="container" style="width:800px;margin:0 auto;">
    <?php
        if (!empty($_POST['email'])) {
                if (empty($_SESSION['user'])) {
                    $_SESSION['user'] = [];
                }
                $_SESSION['is_auth'] = true;

                $res_check = '';
                if(!empty($_SESSION['user'])){
                    foreach($_SESSION['user'] as $value){
                        if(in_array($_POST['email'],$value)){
                            $res_check .= '1,';
                        }else{
                            $res_check .= '0,';
                        }
                    }
                    $pos = strpos($res_check,'1');
                }
                $id = count($_SESSION['user']);
                if(!empty($_SESSION['user']) && $res_check!=''){
                    if(isset($pos) && $pos===false){
                        $_SESSION['last_id'] = $id;
                        $_SESSION['user'][$id] = [
                            'email' => $_POST['email'],
                            'pass' => $_POST['pass']
                        ];
                    }
                }else{
                    $_SESSION['last_id'] = $id;
                    $_SESSION['user'][$id] = [
                        'email' => $_POST['email'],
                        'pass' => $_POST['pass']
                    ];
                }
        }
    ?>

    <?php if(empty($_SESSION['user']) || !$_SESSION['is_auth']){ ?>
        <form method="post">
            <br>
            <div class="col-sm-6 mb-3">
                <label for="inputEmail" class="form-label">Email</label>
                <input type="email" placeholder="Email адреса" class="form-control" name="email">
            </div>
            <div class="col-sm-6 mb-3">
                <label for="inputPassword" class="form-label">Password</label>
                <input type="password" placeholder="Пароль" class="form-control" name="pass">
            </div>
            <button type="submit" class="btn btn-primary">Sign up</button>
        </form>
    <?php }else{ ?>
        <?php
            if(count($_SESSION['user'])>0 && isset($pos) && $pos!==false){ ?>
                <div class="alert" role="alert" style="margin:10px 0;font-weight: bold;color:red;">
                    Повторна авторизація за даним Email - заборонена! Введіть інший імейл!
                </div>
            <?php }else{ ?>
                <div class="alert" role="alert" style="margin:10px 0;font-weight: bold;">
                    Ви залогінились з Email: <?= $_SESSION['user'][$_SESSION['last_id']]['email'] ?>
                </div>
            <?php } ?>
        <form method="post">
            <br>
            <div class="col-sm-6 mb-3">
                <label for="inputEmail" class="form-label">Email</label>
                <input type="email" placeholder="Email адреса" class="form-control" name="email">
            </div>
            <div class="col-sm-6 mb-3">
                <label for="inputPassword" class="form-label">Password</label>
                <input type="password" placeholder="Пароль" class="form-control" name="pass">
            </div>
            <button type="submit" class="btn btn-primary">Sign up</button>
        </form>
    <?php } ?>
</div>
</body>
</html>