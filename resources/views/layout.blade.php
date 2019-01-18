<!DOCTYPE html>
<html lang="en">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1"/>
    <link rel="shortcut icon" href="{{URL::asset('assets/images/favicon.png') }}" type="image/x-icon" />
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=5" />
    <meta name="csrf-token" content="{{ csrf_token() }}"/>
    @if(!empty($meta_data))
        <title>{{$meta_data->title}}</title>
        <meta name="description" content="{{$meta_data->description}}" />
        <meta name="keywords" content="{{$meta_data->keywords}}" />
        <meta property="og:url" content="{{Request::url()}}"/>
        <meta property="og:title" content="{{$meta_data->social_title}}"/>
        <meta property="og:description" content="{{$meta_data->social_description}}"/>
        @if(!empty($meta_data->media))
            <meta property="og:image" content="{{URL::asset('assets/uploads/'.$meta_data->media->name)}}"/>
            <meta property="og:image:width" content="1200"/>
            <meta property="og:image:height" content="630"/>
        @endif
    @endif
    @if(!empty(Route::current()) && Route::current()->getName() == 'home')
        <link rel="canonical" href="{{route('home')}}" />
    @endif
    <style>

    </style>
    <link rel="stylesheet" type="text/css" href="/dist/css/front-libs-style.css">
    <link rel="stylesheet" type="text/css" href="/assets/css/style.css">
    <script>
        var HOME_URL = '{{ route("home") }}';
    </script>
</head>
<body class="@if(!empty(Route::current())) {{Route::current()->getName()}} @else class-404 @endif">
<header>
    <div class="container">
        <div class="row fs-0">
            <figure itemscope="" itemtype="http://schema.org/Organization" class="col-xs-3 logo-container inline-block">
                <a itemprop="url" href="{{ route('home') }}" @if(!empty(Route::current())) @if(Route::current()->getName() == "home") tabindex="=-1" @endif @endif>
                    <img src="{{URL::asset('assets/images/logo.svg') }}" itemprop="logo" alt="Dentacoin logo" class="max-width-50 max-width-xs-40"/>
                </a>
            </figure>
            <nav class="col-xs-9 inline-block">
                <ul itemscope="" itemtype="http://schema.org/SiteNavigationElement">
                    <li class="inline-block @if(!empty(Route::current())) @if(Route::current()->getName() == "home") active @endif @endif"><a href="{{route('home')}}" itemprop="url"><span itemprop="name">Dentists</span></a></li>
                    <li class="inline-block">|</li>
                    <li class="inline-block @if(!empty(Route::current())) @if(Route::current()->getName() == "patients") active @endif @endif"><a href="{{route('patients')}}" itemprop="url"><span itemprop="name">Patients</span></a></li>
                    <li class="inline-block">
                        <a href="" itemprop="url" class="blue-green-white-btn sign-in"><span itemprop="name">SIGN IN</span></a>
                    </li>
                </ul>
            </nav>
        </div>
    </div>
</header>
<main>@yield("content")</main>
<footer>
    <div class="container">
        <div class="row">
            <div class="col-xs-12 col-sm-10 col-sm-offset-1">
                <hr/>
            </div>
        </div>
        @if(!empty(Route::current()))
            @php($footer_menu = \App\Http\Controllers\Controller::instance()->getMenu('footer'))
        @endif
        @if(!empty($footer_menu) && sizeof($footer_menu) > 0)
            <div class="row">
                <div class="col-xs-12 col-sm-8 col-sm-offset-2">
                    <nav class="row fs-0">
                        <ul itemscope="" itemtype="http://schema.org/SiteNavigationElement">
                            @foreach($footer_menu as $menu_el)
                                @if((isset($mobile) && $mobile && $menu_el->mobile_visible) || (isset($mobile) && !$mobile && $menu_el->desktop_visible))
                                    <li class="inline-block-top col-xs-4"><a @if($menu_el->new_window) target="_blank" @endif itemprop="url" href="{{$menu_el->url}}"><span itemprop="name">{!! $menu_el->name !!}</span></a></li>
                                @endif
                            @endforeach
                        </ul>
                    </nav>
                </div>
            </div>
        @endif
        <div class="row padding-bottom-50 padding-top-50 text-center fs-14 bottom-text">
            <div class="col-xs-12">© 2018 Dentacoin Foundation. All rights reserved.</div>
            <div class="col-xs-12">
                <a href="//dentacoin.com/assets/uploads/dentacoin-foundation.pdf" class="inline-block dark-color" target="_blank">Verify Dentacoin Foundation</a>
                <li class="inline-block separator padding-left-5 padding-right-5">|</li>
                <a href="//dentacoin.com/privacy-policy" target="_blank" class="inline-block dark-color">Privacy Policy</a>
            </div>
        </div>
    </div>
</footer>
{{--//Show the sticky calculate button only for dentists--}}
@if(!empty(Route::current()) && Route::current()->getName() == 'home')
    <figure class="fixed-calculate-button" itemscope="" itemtype="http://schema.org/ImageObject">
        <a href="javascript:void(0);" class="open-calculator">
            <img alt="Sticky calculator button" itemprop="contentUrl" src="/assets/uploads/sticky-calculator-button.png"/>
        </a>
    </figure>
@endif
<script src="/assets/js/basic.js"></script>
<script src="/dist/js/front-libs-script.js?v=1.0.14"></script>
@yield("script_block")
{{--<script src="/dist/js/front-script.js?v=1.0.13"></script>--}}
<script src="/assets/js/index-compiled.js"></script>
<script src="/assets/libs/civic-login/civic.js"></script>
<script src="/assets/libs/facebook-login/facebook.js"></script>
</body>
</html>