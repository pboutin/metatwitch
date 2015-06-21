<!doctype html>
<html>
<head>
    <link rel="stylesheet" href="css/login.css"/>
</head>
<body>
    <div class="mask"></div>
    <video autoplay loop muted class="background">
        <source src="video/djerocku.webm" type="video/webm">
        <source src="video/djerocku.mp4" type="video/mp4">
    </video>
    <h1>{{trans('login.heading')}}</h1>
    <a href="/dashboard" class="btn btn-primary btn-login">
        <i class="fa fa-twitch"></i> {{trans('login.cta')}}
    </a>
</body>
</html>