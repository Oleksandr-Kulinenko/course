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
    <?php if (
        !empty($_POST['email']) && !empty($_POST['pass'])
    ) : ?>
        <div class="alert" role="alert" style="margin:10px 0;font-weight: bold;">
            Ви намагались залогінитись з Email:<br> <?= $_POST['email']; ?>
        </div>
    <?php endif; ?>
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
