const fb_config = {
    app_id: '299398824049604',
    platform: 'fb'
};

var fb_custom_btn = $('.facebook-custom-btn');
if(fb_custom_btn.length) {
    
    //application init
    window.fbAsyncInit = function () {
        FB.init({
            appId: fb_config.app_id,
            cookie: true,
            xfbml: true,
            version: 'v2.8'
        });
        FB.AppEvents.logPageView();
    };

    (function (d, s, id) {
        var js, fjs = d.getElementsByTagName(s)[0];
        if (d.getElementById(id)) {
            return;
        }
        js = d.createElement(s);
        js.id = id;
        js.src = '//connect.facebook.net/bg_BG/sdk.js';
        fjs.parentNode.insertBefore(js, fjs);
    }(document, 'script', 'facebook-jssdk'));

    //login method
    function fbLogin(rerequest) {
        var obj = {
            scope: 'email'
        };
        if(rerequest){
            obj.auth_type = 'rerequest';
        }
        FB.login(function (response) {
            if(response.authResponse) {
                customFacebookEvent('receivedFacebookToken', 'Received facebook token successfully.', response);

                var fb_token = response.authResponse.accessToken;

                //for exchange token with user data, but we do this on API level and we dont need it here
                //fbGetData();

                console.log($('meta[name="csrf-token"]').attr('content'), '$(\'meta[name="csrf-token"]\').attr(\'content\')');
                $.ajax({
                    type: 'POST',
                    dataType: 'json',
                    url: fb_custom_btn.attr('data-url'),
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    data: {
                        platform: fb_custom_btn.attr('data-platform'),
                        social_network: fb_config.platform,
                        auth_token: fb_token,
                        type: fb_custom_btn.attr('data-type')
                    },
                    success: function(data){
                        if (data.success) {
                            customFacebookEvent('successResponseCoreDBApi', 'Request to CoreDB-API succeed.', data);
                        } else {
                            customFacebookEvent('errorResponseCoreDBApi', 'Request to CoreDB-API succeed, but conditions failed.', data);
                        }
                    },
                    error: function() {
                        customFacebookEvent('noCoreDBApiConnection', 'Request to CoreDB-API failed.');
                    }
                });
            }
        }, obj);
    }

    //bind the login method to button
    fb_custom_btn.click(function() {
        customFacebookEvent('facebookCustomBtnClicked', 'Button #civic-custom-btn was clicked.');
        fbLogin();
    });

    //exchanging token for data
    function fbGetData() {
        FB.api('/me?fields=id,email,name,permissions', function (response) {
            customFacebookEvent('receivedFacebookData', 'Received facebook data successfully.', response);
        });
    }

    function customFacebookEvent(type, message, response_data) {
        var event_obj = {
            type: type,
            message: message,
            time: new Date()
        };

        if(response_data != undefined) {
            event_obj.response_data = response_data;
        }
        $.event.trigger(event_obj);
    }
}