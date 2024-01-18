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
    <style>
        table, th, td {
            border: 1px solid black;
            padding: 5px;
        }
    </style>
</head>
<body style="background-color:#F4F4F4;">
<div class="container" style="width:800px;margin:0 auto;">

<?php
    if(file_exists("../auth_log.txt")){
        $file = "../auth_log.txt";
        $arr_file = file($file);
        if(!empty($_POST) && !empty($arr_file)){
            if(isset($_POST['choose_str']) && $_POST['choose_str']!='*'){
                unset($arr_file[$_POST['choose_str']]);
                file_put_contents($file, $arr_file); ?>
                <div class="alert" role="alert" style="margin:10px 0;font-weight: bold;color:green;">
                    Запис видалено!
                </div>
            <?php }else{ ?>
                <div class="alert" role="alert" style="margin:10px 0;font-weight: bold;color:red;">
                    Помилка видалення запису!
                </div>
            <?php }
        }

        if (!empty($arr_file)) {
            $cnt = 0;
            foreach($arr_file as $val){
                $arr_str = explode(";",$val);
                $arr_out[]=array(
                    'id_del' => $cnt,
                    'id_on_page' => $arr_str[0],
                    'email' => $arr_str[1],
                    'pass' => $arr_str[2]
                );
                $cnt++;
            } ?>
    <br><hr>
    <h2>Data auth user</h2>
    <hr><br>
    <div id="data_file" style="margin: 10px auto;">
        <table>
            <th style="text-align: center;">Id</th>
            <th style="text-align: center;">Email</th>
            <th style="text-align: center;">Pass</th>
            <?php foreach($arr_out as $val){ ?>
                <tr>
                    <td style="text-align: center;"><?= $val['id_on_page']?></td>
                    <td style="text-align: center;"><?= $val['email']?></td>
                    <td style="text-align: center;"><?= $val['pass']?></td>
                </tr>
            <?php } ?>
        </table>
    </div>
    <br><hr>
    <h5>Form for delete user auth</h5>
    <hr><br>
    <form method="post">
        <select name="choose_str">
            <option value="*"></option>
            <?php foreach($arr_out as $val){ ?>
                <option value="<?= $val['id_del'] ?>"><?= $val['email'] ?></option>
            <?php } ?>
        </select>
        <button type="submit" class="btn btn-primary">Delete</button>
    </form>
</div>
</body>
</html>
        <?php }else{ ?>
            <div class="alert" role="alert" style="margin:10px 0;font-weight: bold;color:red;">
                Лог авторизації пустий!
            </div>
        <?php }
    }else{ ?>
        <div class="alert" role="alert" style="margin:10px 0;font-weight: bold;color:red;">
            Лог авторизації пустий!
            </div>
    <?php } ?>
