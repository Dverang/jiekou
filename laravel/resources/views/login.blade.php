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
                <img src="images/logo.png" >
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
                    <div class="form-group">
                        <label class="t"></label>
                        <label for="j_remember" class="m">
                            <input id="j_remember" type="checkbox" value="true">&nbsp;记住登陆账号!</label>
                    </div>
                    <div class="form-group space">
                        <label class="t"></label>　　
                        <!--<input type="submit" value="登陆"/>　-->
                        <button type="button"  id="submit_btn"
                                class="btn btn-primary btn-lg">&nbsp;登&nbsp;录&nbsp </button>
                        <input type="reset" value="&nbsp;重&nbsp;置&nbsp;" class="btn btn-default btn-lg">
                        <a href="{{url('register')}}">注册</a>
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
                url: "{{url('login')}}",
                data: "email="+email+"&password="+password,
                success: function(msg){
//                    alert(msg)
                    if(msg==0){
                        window.location.href="http://www.lg.com/jiekou/laravel/public/list";
                    }
                }
            });

//            show_loading();
            {{--var myReg = /^\w+([-+.]\w+)*@\w+([-.]\w+)*\.\w+([-.]\w+)*$/; //邮件正则--}}
            {{--if($('#email').val() == ''){--}}
                {{--show_err_msg('邮箱还没填呢！');--}}
                {{--$('#email').focus();--}}
            {{--}else if(!myReg.test($('#email').val())){--}}
                {{--show_err_msg('您的邮箱格式错咯！');--}}
                {{--$('#email').focus();--}}
            {{--}else if($('#password').val() == ''){--}}
                {{--show_err_msg('密码还没填呢！');--}}
                {{--$('#password').focus();--}}
            {{--}else{--}}
                {{--//ajax提交表单，#login_form为表单的ID。 如：$('#login_form').ajaxSubmit(function(data) { ... });--}}
                {{--show_msg('登录成功咯！  正在为您跳转...','/');--}}
            {{--}--}}
        });
    });
</script>