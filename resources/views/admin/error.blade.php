<!DOCTYPE html>
<html lang="zh">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no"/>
    <title>出错啦</title>
    <link rel="icon" href="/favicon.ico" type="image/ico">
    <link href="/lyear/css/bootstrap.min.css" rel="stylesheet">
    <link href="/lyear/css/materialdesignicons.min.css" rel="stylesheet">
    <link href="/lyear/css/style.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #fff;
        }

        .error-page {
            height: 100%;
            position: fixed;
            width: 100%;
        }

        .error-body {
            padding-top: 5%;
        }

        .error-body h1 {
            font-size: 100px;
            font-weight: 700;
            text-shadow: 4px 4px 0 #f5f6fa, 6px 6px 0 #33cabb;
            line-height: 210px;
            color: #33cabb;
        }

        .error-body h4 {
            margin: 30px 0px;
        }
    </style>
</head>

<body>
<section class="error-page">
    <div class="error-box">
        <div class="error-body text-center">
            <h1>{{$code}}</h1>
            <h4>{{$message}}</h4>
            <a href="{{$link??'javascript:'}}" class="btn btn-primary ">返回首页</a>
        </div>
    </div>
</section>
</body>
</html>