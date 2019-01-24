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
<body class="@if(!empty(Route::current())) {{Route::current()->getName()}} @else class-404 @endif @if(\App\Http\Controllers\UserController::instance()->checkSession()) logged-in @endif">
<header>
    <div class="container">
        <div class="row fs-0">
            <figure itemscope="" itemtype="http://schema.org/Organization" class="col-xs-3 logo-container inline-block">
                <a itemprop="url" href="{{ route('home') }}" @if(!empty(Route::current())) @if(Route::current()->getName() == "home") tabindex="=-1" @endif @endif>
                    <img src="{{URL::asset('assets/images/logo.svg') }}" itemprop="logo" alt="Dentacoin logo" class="max-width-50 max-width-xs-40"/>
                </a>
            </figure>
            @if(!\App\Http\Controllers\UserController::instance()->checkSession())
                <nav class="col-xs-9 inline-block">
                    <ul itemscope="" itemtype="http://schema.org/SiteNavigationElement">
                        <li class="inline-block @if(!empty(Route::current())) @if(Route::current()->getName() == "home") active @endif @endif"><a href="{{route('home')}}" itemprop="url"><span itemprop="name">Dentists</span></a></li>
                        <li class="inline-block">|</li>
                        <li class="inline-block @if(!empty(Route::current())) @if(Route::current()->getName() == "patient-access") active @endif @endif"><a href="{{route('patient-access')}}" itemprop="url"><span itemprop="name">Patients</span></a></li>
                        <li class="inline-block">
                            <a href="javascript:void(0)" itemprop="url" class="blue-green-white-btn show-login-signin"><span itemprop="name">LOG IN</span></a>
                        </li>
                    </ul>
                </nav>
            @else
                <div class="col-xs-9 inline-block text-right logged-user">
                    <a href="javascript:void(0)">
                        <span>{{session('logged_user')['name']}}</span> <i class="fa fa-user-circle-o" aria-hidden="true"></i>
                    </a>
                    <div class="hidden-box">
                        <div class="container-fluid text-center">
                            <div class="row">
                                <div class="col-xs-6 inline-block">
                                    <a href="{{ route('user-logout') }}" class="logout"><i class="fa fa-power-off" aria-hidden="true"></i> Log out</a>
                                </div>
                                <div class="col-xs-6 inline-block">
                                    <a href="{{ route('my-profile') }}" class="white-blue-green-btn">My profile</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @endif
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
{{--Show the sticky calculate button only for dentists--}}
@if(!empty(Route::current()) && Route::current()->getName() == 'home')
    <figure class="fixed-calculate-button" itemscope="" itemtype="http://schema.org/ImageObject">
        <a href="javascript:void(0);" class="open-calculator">
            <img alt="Sticky calculator button" itemprop="contentUrl" src="/assets/uploads/sticky-calculator-button.png"/>
        </a>
    </figure>
@endif
{{--/Show the sticky calculate button only for dentists--}}
<script src="/assets/js/basic.js"></script>
<script src="/dist/js/front-libs-script.js?v=1.0.14"></script>
@yield("script_block")
{{--<script src="/dist/js/front-script.js?v=1.0.13"></script>--}}
<script src="/assets/js/index-compiled.js"></script>
<script src="//dentacoin.com/assets/libs/civic-login/civic.js"></script>
<script src="//dentacoin.com/assets/libs/facebook-login/facebook.js"></script>
<script>
    var initAddressSuggesters;

    jQuery(document).ready(function($){

        var mapsLoaded = true;
        var mapsWaiting = [];



        //
        //Maps stuff
        //


        var prepareMapFucntion = function( callback ) {
            console.log('prepareMapFucntion');
            if(mapsLoaded) {
                console.log('prepareMapFucntion', '1');
                callback();
            } else {
                console.log('prepareMapFucntion', '2');
                mapsWaiting.push(callback);
            }
        };

        var initMap = function () {
            console.log('initMap');
            mapsLoaded = true;
            for(var i in mapsWaiting) {
                mapsWaiting[i]();
            }

            $('.map').each( function(){
                var address = $(this).attr('data-address') ;

                var geocoder = new google.maps.Geocoder();
                geocoder.geocode( { 'address': address}, (function(results, status) {
                    console.log(address);
                    console.log(status);
                    if (status == google.maps.GeocoderStatus.OK) {
                        if (status != google.maps.GeocoderStatus.ZERO_RESULTS) {
                            var position = {
                                lat: results[0].geometry.location.lat(),
                                lng: results[0].geometry.location.lng()
                            };

                            map = new google.maps.Map($(this)[0], {
                                center: position,
                                scrollwheel: false,
                                zoom: 15
                            });

                            new google.maps.Marker({
                                position: position,
                                map: map,
                                title: results[0].formatted_address
                            });

                        } else {
                            console.log('456');
                            $(this).remove();
                        }
                    } else {
                        console.log('123');
                        $(this).remove();
                    }
                }).bind( $(this) )  );

            });
        };



        initAddressSuggesters = function() {
            console.log('initAddressSuggesters');

            prepareMapFucntion( function() {
                console.log('prepareMapFucntion');

                $('.address-suggester').each( function() {
                    var conatiner = $(this).closest('.address-suggester-wrapper');

                    conatiner.find('.country-select').change( function() {
                        var cc = $(this).find('option:selected').attr('code');
                        GMautocomplete.setComponentRestrictions({
                            'country': cc
                        });
                    } );


                    if( conatiner.find('.suggester-map-div').attr('lat') ) {
                        var coords = {
                            lat: parseFloat( conatiner.find('.suggester-map-div').attr('lat') ),
                            lng: parseFloat( conatiner.find('.suggester-map-div').attr('lon') )
                        };

                        conatiner.find('.suggester-map-div').show();
                        var profile_address_map = new google.maps.Map( conatiner.find('.suggester-map-div')[0], {
                            center: coords,
                            zoom: 14,
                            backgroundColor: 'none'
                        });

                        var marker = new google.maps.Marker({
                            map: profile_address_map,
                            center: coords,
                        });
                    }


                    var input = $(this)[0];
                    var cc = conatiner.find('.country-select option:selected').attr('code');
                    var options = {
                        componentRestrictions: {
                            country: cc
                        },
                        types: ['address']
                    };

                    console.log('hmm');

                    var GMautocomplete = new google.maps.places.Autocomplete(input, options);
                    GMautocomplete.conatiner = conatiner;
                    google.maps.event.addListener(GMautocomplete, 'place_changed', (function () {
                        var place = this.getPlace();

                        this.conatiner.find('.address-suggester').blur();
                        this.conatiner.find('.geoip-hint').hide();
                        this.conatiner.find('.suggester-map-div').hide();

                        if( place && place.geometry ) {
                            //address_components
                            console.log(place);
                            console.log( place.formatted_address )
                            console.log( place.types ); //street_address
                            console.log( place.geometry.location.lat() )
                            console.log( place.geometry.location.lng() )


                            if( place.types.indexOf('street_address')!=-1 || place.types.indexOf('street_number')!=-1 ) {
                                var cname = '';
                                var newaddress = place.name + ', ' + place.vicinity;
                                this.conatiner.find('.address-suggester').val(newaddress);

                                prepareMapFucntion( (function() {
                                    var coords = {
                                        lat: place.geometry.location.lat(),
                                        lng: place.geometry.location.lng()
                                    };

                                    this.conatiner.find('.suggester-map-div').show();
                                    var profile_address_map = new google.maps.Map( this.conatiner.find('.suggester-map-div')[0], {
                                        center: coords,
                                        zoom: 14,
                                        backgroundColor: 'none'
                                    });

                                    var marker = new google.maps.Marker({
                                        map: profile_address_map,
                                        center: coords,
                                    });

                                }).bind(this) );

                                return;
                            }

                        }

                        this.conatiner.find('.geoip-hint').show();
                    }).bind(GMautocomplete));

                } )

            });

            $('.address-suggester').on('keyup keypress', function(e) {
                var keyCode = e.keyCode || e.which;
                if (keyCode === 13) {
                    e.preventDefault();
                    return false;
                }
            });
        };

        if( $('.address-suggester').length ) {
            initAddressSuggesters();
        }
    });
</script>
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCaVeHq_LOhQndssbmw-aDnlMwUG73yCdk&libraries=places&callback=initMap&language=en"></script>
</body>
</html>