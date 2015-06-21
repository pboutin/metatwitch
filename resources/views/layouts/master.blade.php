<!doctype html>
<html>
    <head>
        <link rel="stylesheet" href="css/main.css"/>
    </head>
    <body>
        <nav class="navbar navbar-default">
            <div class="large-container">
                <div class="navbar-header">
                    <a class="navbar-brand" href="#">
                        <img alt="Brand" src="http://placecage.com/75/25">
                    </a>
                </div>
                <div class="navbar-right">
                    <ul class="nav navbar-nav">
                        <li class="navbar-text">Dalran</li>
                        <li><a href="{{ url('logout') }}"><i class="fa fa-sign-out"></i> {{trans('master.logout')}}</a></li>
                    </ul>
                </div>
            </div>
        </nav>

        <div class="large-container">
            @yield('content')
        </div>

        <script type="text/javascript" src="js/vendors.js"></script>
        <script type="text/javascript" src="js/main.js"></script>
    </body>
</html>