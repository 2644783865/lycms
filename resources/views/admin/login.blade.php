<!DOCTYPE html>
<html lang="zh">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no"/>
    <title>LyCMS后台管理系统</title>
    <link rel="icon" href="/favicon.ico" type="image/ico">
    <meta name="keywords" content="LyCMS">
    <meta name="description" content="LyCMS">
    <link href="/lyear/css/bootstrap.min.css" rel="stylesheet">
    <link href="/lyear/css/materialdesignicons.min.css" rel="stylesheet">
    <link href="/lyear/css/animate.css" rel="stylesheet">
    <link href="/lyear/css/style.min.css" rel="stylesheet">

    <style>
        .lyear-wrapper {
            position: relative;
        }

        .lyear-login {
            display: flex !important;
            min-height: 85vh;
            align-items: center !important;
            justify-content: center !important;
        }

        .login-center {
            background: #fff;
            min-width: 38.25rem;
            padding: 2.14286em 3.57143em;
            border-radius: 5px;
            margin: 2.85714em 0;
        }

        .login-header {
            margin-bottom: 1.5rem !important;
        }

        .login-center .has-feedback.feedback-left .form-control {
            padding-left: 38px;
            padding-right: 12px;
        }

        .login-center .has-feedback.feedback-left .form-control-feedback {
            left: 0;
            right: auto;
            width: 38px;
            height: 38px;
            line-height: 38px;
            z-index: 4;
            color: #dcdcdc;
        }

        .login-center .has-feedback.feedback-left.row .form-control-feedback {
            left: 15px;
        }
    </style>
</head>

<body>
<div class="row lyear-wrapper">
    <div class="lyear-login">
        <div class="login-center">
            <div class="login-header text-center">
                <a href="/"> <img alt="LyCMS" src="/logo.png" style="height: 40px;"> </a>
            </div>
            <form action="{{route('admin.login')}}" method="post">
                <div class="form-group has-feedback feedback-left">
                    {{ csrf_field() }}
                    <input type="email" placeholder="请输入您的邮箱" class="form-control" name="email" value="{{old('email')}}"
                           required/>
                    <span class="mdi mdi-lock form-control-feedback" aria-hidden="true"></span>
                </div>
                <div class="form-group has-feedback feedback-left">
                    <input type="password" placeholder="请输入密码" class="form-control" name="password" value="" required/>
                    <span class="mdi mdi-lock form-control-feedback" aria-hidden="true"></span>
                </div>
                <div class="form-group">
                    <button class="btn btn-block btn-primary" type="submit">立即登录</button>
                </div>
            </form>
        </div>
    </div>
</div>
<script type="text/javascript" src="/lyear/js/jquery.min.js"></script>
<script type="text/javascript" src="/lyear/js/bootstrap.min.js"></script>
<script src="/lyear/js/bootstrap-notify.min.js"></script>
<script type="text/javascript" src="/lyear/js/lightyear.js"></script>
<script type="text/javascript">
    @if($errors->any())
    $(function () {
        lightyear.notify('用户名或密码错误，请重试！', 'danger');
    });
    @endif
</script>
</body>
</html>