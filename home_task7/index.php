<!DOCTYPE html>
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
    $file = "auth_log.txt";
    if(!file_exists($file)){
        $fp = fopen($file, "a+") or die("Couldn't read the file");
    }
    $arr_file = file($file);
    if (!empty($_POST['email'])) {
        $file = "auth_log.txt";
        if(empty($arr_file)){
            $id_str = 1;
            $fp = fopen($file, "a+") or die("Couldn't read the file");
            $str_auth = $id_str.";".$_POST['email'].";".$_POST['pass'];
            fwrite($fp, $str_auth . PHP_EOL);
            fclose($fp); ?>
            <div class="alert" role="alert" style="margin:10px 0;font-weight: bold;color:green;">
                Ви залогінились з Email: <?= $_POST['email'] ?>
            </div>
        <?php } else{
            foreach($arr_file as $val){
                $arr_str = explode(";",$val);
                $arr_check[] = $arr_str[0];
            }
            $id_str = max($arr_check) + 1;
            $res_check = '';
            if(!empty($arr_file)){
                foreach($arr_file as $val){
                    if(strpos($val,$_POST['email'])){
                        $res_check .= '1,';
                    }else{
                        $res_check .= '0,';
                    }
                }

                $pos = strpos($res_check,'1');

                if(isset($pos) && $pos===false){
                    $fp = fopen($file, "a+") or die("Couldn't read the file");
                    $str_auth = $id_str.";".$_POST['email'].";".$_POST['pass'];
                    fwrite($fp, $str_auth . PHP_EOL);
                    fclose($fp); ?>
                    <div class="alert" role="alert" style="margin:10px 0;font-weight: bold;color:green;">
                        Ви залогінились з Email: <?= $_POST['email'] ?>
                    </div>
                <?php }else{ ?>
                    <div class="alert" role="alert" style="margin:10px 0;font-weight: bold;color:red;">
                        Повторна авторизація за даним Email - заборонена! Введіть інший імейл!
                    </div>
                <?php }
            }
        }
    }

    ?>

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
</div>
</body>
</html>