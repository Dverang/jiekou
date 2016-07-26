<!DOCTYPE html>
<html lang="en" class="no-js">
<head>
    <meta charset="utf-8">
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    <title>html5响应式后台登录界面模板</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">
    <!-- CSS -->
    <link rel="stylesheet" href="css/supersized.css">
    <link rel="stylesheet" href="css/login.css">
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <!-- HTML5 shim, for IE6-8 support of HTML5 elements -->
    <!--[if lt IE 9]>
    <script src="js/html5.js"></script>
    <![endif]-->
    <script src="js/jquery-1.8.2.min.js"></script>
    <script type="text/javascript" src="js/jquery.form.js"></script>
    <script type="text/javascript" src="js/tooltips.js"></script>
    {{--<script type="text/javascript" src="js/login.js"></script>--}}
</head>

<body>

<div class="page-container">
    <div class="main_box">
        <div class="login_box">
            <div class="login_logo">
                <img src="images/logo1.png" >
            </div>

            <div class="login_form">
                <form action="Index/httppost" id="login_form" method="post">
                    <div class="form-group">
                        <label for="j_username" class="t">邮　箱：</label>
                        <input id="email" value="" name="email" type="text" class="form-control x319 in"
                               autocomplete="off">
                    </div>
                    <div class="form-group">
                        <label for="j_password" class="t">密　码：</label>
                        <input id="password" value="" name="password" type="password"
                               class="password form-control x319 in">
                    </div>
                    <div class="form-group">
                        <label for="j_captcha" class="t">验证码：</label>
                        <input id="j_captcha" name="j_captcha" type="text" class="form-control x164 in">
                        <img id="captcha_img" alt="点击更换" title="点击更换" src="images/captcha.jpeg" class="m">
                    </div>

                    <div class="form-group space">
                        <label class="t"></label>　　
                        <!--<input type="submit" value="登陆"/>　-->
                        <button type="button"  id="submit_btn"
                                class="btn btn-primary btn-lg">&nbsp;注&nbsp;册&nbsp </button>
                        <input type="reset" value="&nbsp;重&nbsp;置&nbsp;" class="btn btn-default btn-lg">
                        <a href="{{url('/')}}">立即登陆</a>
                    </div>
                </form>
            </div>
        </div>
        <div class="bottom">Copyright &copy; 2014 - 2015 <a href="#">系统登陆</a></div>
    </div>
</div>

<!-- Javascript -->

<script src="js/supersized.3.2.7.min.js"></script>
<script src="js/supersized-init.js"></script>
<script src="js/scripts.js"></script>
<div style="text-align:center;">
</div>
</body>
</html>
<script type="text/javascript">
    document.onkeydown = function(e){
        if($(".bac").length==0)
        {
            if(!e) e = window.event;
            if((e.keyCode || e.which) == 13){
                var obtnLogin=document.getElementById("submit_btn")
                obtnLogin.focus();
            }
        }
    }

    $(function(){
        //提交表单
        $('#submit_btn').click(function(){
            var email=$("#email").val();
            var password=$("#password").val();
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $.ajax({
                type: "POST",
                url: "{{url('register')}}",
                data: "email="+email+"&password="+password,
                success: function(msg){
                    alert(msg);
                }
            });
        });
    });
</script>