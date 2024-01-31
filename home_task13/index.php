<!DOCTYPE html>
<?php
    require_once('database.php');

    $connection = getConnection();

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
    <script src="https://code.jquery.com/jquery-3.7.1.js"
            integrity="sha256-eKhayi8LEQwp4NKxN+CfCh+3qOVUtJn3QNZ0TciWLP4=" crossorigin="anonymous">
    </script>
    <script>
        function logOut(){
            $("#auth-form").css('display','block');
            $("#auth-form").trigger('reset');
            $("#message-form").css('display','none');
            $("#list-of-messages").html('');
            getAllMessages();
            $("#header-auth").html('');
            $("#res-auth").html('<div class="alert" role="alert" style="margin:10px 0;font-weight: bold;color:green;">Ви успішно вийшли! Для відправки повідомлень авторизуйтесь</div>');
        }

        function getId(id){
            let data = {
                message_id: id,
                func: 'deleteMessage'
            };
            $.ajax({
                url: 'message.php',
                method: 'POST',
                data: data,
                success: function success(response) {
                    if(response.error){
                        $("#res-auth").html('<div class="alert" role="alert" style="margin:10px 0;font-weight: bold;color:red;">' + response.error + '</div>');
                        $("#auth-form").trigger('reset');
                    }
                    if(response.success){
                        $("#res-auth").html('<div class="alert" role="alert" style="margin:10px 0;font-weight: bold;color:green;">' + response.success + '</div>');
                        $("#list-of-messages").html('');
                        let user_id = $('input[name="user_id"]').val();
                        let data = {
                            user_id: user_id,
                            func: 'getRoleUser'
                        };

                        $.ajax({
                            url: 'authorization.php',
                            method: 'POST',
                            data : data,
                            success: function (request) {
                                $("#header-auth").html('<div class="alert" role="alert" style="margin:10px 0;font-weight: bold;color:darkgreen;">' +
                                    '<p style="float:left;width:95%"><img src="img/user_profile.png" height="42" width="42" style="margin-right:10px;"><span style="font-size:20px;color:black;">' + request.username + '</span></p>' +
                                    "<input type='image' src='img/exit.png' onclick='logOut();' height='32' width='32'/>" +
                                    '</div>');
                                getAllMessages(request.role);
                            }
                        })
                    }
                }
            })
        }

        function appendComment(id, name, message, role, date_added, b_color) {
                if(role!=='' && role==='admin'){
                    $("#list-of-messages").append(
                        "<div style='float:left;'><img src='img/user_say.png' height='40' width='40' style='margin-right:10px;'><span style='font-size: 18px;margin-right: 10px;'><i><b>" + name + "</b></i></span><i>"+ date_added +"</i></div>" +
                        "<li class='list-group-item' style='" + b_color + "'><i>" + message + "</i><input id='del-mess' value='" + id + "' onclick='getId("+ id + ")' name='del-mess' type='image' style='position: absolute;top: 10px;right: 15px;' src='img/delete.png' height='22' width='22' /></li>"
                    );
                }else{
                    $("#list-of-messages").append(
                        "<div style='float:left;'><img src='img/user_say.png' height='40' width='40' style='margin-right:10px;'><span style='font-size: 18px;margin-right: 10px;'><i><b>" + name + "</b></i></span><i>"+ date_added +"</i></div>" +
                        "<li class='list-group-item' style='" + b_color + "'><i>" + message + "</i></li>"
                    );
                }
        }

        $(document).ready(function () {
            getAllMessages();
        });
    </script>
</head>
<body>
    <div class="container">
        <div id="header-auth">

        </div>
        <div class="card" style="margin-top:10px;border:none;">
            <div class="col-sm-12">
                <div class="col-sm-8" style="margin-left:400px;"><img src="img/header_page_img.png" height="180" width="280"></div>
                <div class="col-sm-4" style="float:right;font-size: 28px;margin-top:-100px;margin-right: 150px;"><b>Simple Chat</b></div>
            </div>
            <ul class="list-group list-group-flush" id="list-of-messages"></ul>
        </div>
        <div style="clear:both;"></div>
        <div class="card" style="margin-top:20px;border:none;">

        </div>
        <div id="res-auth"><div class="alert" role="alert" style="margin:10px 0;font-weight: bold;color:red;">
                Для того щоб відправляти повідомлення авторизуйтесь нижче!
            </div>
        </div>
        <br>
            <div id="form-container">
                <form method="post" id="auth-form" style="display:block">
                    <div class="mb-3">
                        <label for="exampleInputEmail" class="form-label">Email</label>
                        <input type="text" class="form-control" name="email">
                    </div>
                    <div class="mb-3">
                        <label for="exampleInputPassword" class="form-label">Password</label>
                        <input type="password" class="form-control" name="pass">
                    </div>

                    <button type="submit" class="btn btn-primary">Log In</button>
                </form>
                <form method="post" id="message-form" style="display:none;">
                    <div style="clear:both;"></div>
                    <div class="mb-3">
                        <label for="exampleInputMessage" class="form-label">Message will be sent by</label>
                        <input type="text" id="user-name" value="" class="form-control" name="name" disabled="disabled">
                        </div>
                    <div class="mb-3">
                        <label for="exampleInputMessage" class="form-label">Message</label>
                        <input type="text" class="form-control" name="message">
                        </div>
                    <input type="hidden" class="form-control" name="user_id" value="">
                    <button type="submit" class="btn btn-primary">Send Message</button>
                </form>
            </div>
    </div>
    <div style="margin-bottom: 50px;"></div>
    <script  type="text/javascript">
            $("#auth-form").submit(function (event) {
                event.preventDefault();

                let data = {
                    email: $(this).find('input[name="email"]').val(),
                    pass: $(this).find('input[name="pass"]').val()
                };

                $.ajax({
                    url: 'authorization.php',
                    method: 'POST',
                    data: data,
                    success: function success(response) {
                        if(response.error){
                            $("#res-auth").html('<div class="alert" role="alert" style="margin:10px 0;font-weight: bold;color:red;">'+ response.error +'</div>');
                            $("#auth-form").trigger('reset');
                        }
                        if(response.success){
                            $("#res-auth").html('<div class="alert" role="alert" style="margin:10px 0;font-weight: bold;color:green;">'+ response.success +'</div>');
                            $("#auth-form").css('display','none');
                            $("#message-form").css('display','block');
                            $("#user-name").val(response.username);
                            $("input[name='user_id']").val(response.user_id);

                            $("#header-auth").html('<div class="alert" role="alert" style="margin:10px 0;font-weight: bold;color:darkgreen;">' +
                                '<p style="float:left;width:95%"><img src="img/user_profile.png" height="42" width="42" style="margin-right:10px;"><span style="font-size:20px;color:black;">' + response.username + '</span></p>' +
                                "<input type='image' src='img/exit.png' onclick='logOut();' height='32' width='32' />" +
                            '</div>');
                            $("#list-of-messages").html('');
                            getAllMessages(response.type_user);
                        }
                    }
                })
            });

            $("#message-form").submit(function (event) {

               event.preventDefault();
               let data = {
                   name: $(this).find('input[name="name"]').val(),
                   message: $(this).find('input[name="message"]').val(),
                   user_id: $(this).find('input[name="user_id"]').val(),
                   func: 'addMessage'
               };
                let user_id = $(this).find('input[name="user_id"]').val();
               $.ajax({
                   url: 'message.php',
                   method: 'POST',
                   data: data,
                   success: function success(response) {
                       if(response.error){
                           $("#res-auth").html('<div class="alert" role="alert" style="margin:10px 0;font-weight: bold;color:red;">'+ response.error +'</div>');
                       }
                       if(response.success){
                           $("#res-auth").html('<div class="alert" role="alert" style="margin:10px 0;font-weight: bold;color:green;">'+ response.success +'</div>');
                           $("input[name='message']").val('');
                           $("#list-of-messages").html('');
                           let data = {
                               user_id: user_id,
                               func: 'getRoleUser'
                           };

                           $.ajax({
                               url: 'authorization.php',
                               method: 'POST',
                               data : data,
                               success: function (request) {
                                   getAllMessages(request.role);
                               }
                           })
                       }
                   }
               })

            });

            function getAllMessages(role=''){
                let data = {
                    func: 'getAllMessages'
                };

                $.ajax({
                    url: 'message.php',
                    method: 'POST',
                    data : data,
                    success: function (request) {
                        if (request.data) {
                            for (let i = 1; i < request.data.length; i++) {
                                let reminder = i % 2;
                                if(reminder!=0){
                                    appendComment(request.data[i]['id'], request.data[i]['name'], request.data[i]['message'], role, request.data[i]['date_added'], 'background-color:#F9F495;margin:10px 20px;');
                                }else{
                                    appendComment(request.data[i]['id'], request.data[i]['name'], request.data[i]['message'], role, request.data[i]['date_added'], 'background-color:#FAD777;margin:10px 20px;');
                                }
                            }
                        }
                    }
                })
            }

            function getRoleUser(user_id){
                let data = {
                    user_id: user_id,
                    func: 'getRoleUser'
                };

                $.ajax({
                    url: 'authorization.php',
                    method: 'POST',
                    data : data,
                    success: function (request) {
                        return request;
                    }
                })
            }
    </script>
    </body>
</html>
