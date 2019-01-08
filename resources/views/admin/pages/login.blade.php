<!DOCTYPE html>
<html>
<head>
    <title>Admin login access</title>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <meta name="csrf-token" content="{{ csrf_token() }}"/>
    <link rel="stylesheet" href="/dist/css/admin-libs-style.css">
    <link href="/assets/css/admin.css" rel="stylesheet">
    <script type="text/javascript">
        var SITE_URL = "{{ route('admin-access') }}";
    </script>
</head>
<body>
    <div class="container">
        <div class="row">
            <div class="col-xs-12 col-sm-6 col-md-4 col-sm-offset-3 col-md-offset-4 form-container login">
                <div class="wrapper">
                    <figure class="logo padding-bottom-10 text-center">
                        <a href="{{route('home')}}" target="_blank">
                            <img src="{{URL::asset('assets/images/logo.svg') }}" alt="Dentacoin logo" width="50"/>
                        </a>
                    </figure>
                    <div class="form">
                        @include('admin.partials.error')
                        <form method="POST" action="{{route('authenticate-admin')}}">
                            <div class="form-row">
                                <input placeholder="Username" name="username" type="text">
                            </div>
                            <div class="form-row">
                                <input placeholder="Password" name="password" type="password">
                            </div>
                            <div class="form-row captcha-container fs-0 flex">
                                <span>{!! captcha_img() !!}</span>
                                <button type="button" class="refresh-captcha">
                                    <i class="fa fa-refresh" aria-hidden="true"></i>
                                </button>
                            </div>
                            <div class="form-row">
                                <input type="text" name="captcha" id="captcha" placeholder="Enter captcha"/>
                            </div>
                            <div class="form-row submit text-center">
                                <input type="submit" value="Login">
                                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="/dist/js/admin-libs-script.js"></script>
    <script src="/assets/js/basic.js"></script>
    <script src="/assets/js/admin/index.js"></script>
</body>
</html>

