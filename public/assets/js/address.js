var mapsLoaded = true;
var mapsWaiting = [];

var prepareMapFunction = function( callback ) {
    if(mapsLoaded) {
        callback();
    } else {
        mapsWaiting.push(callback);
    }
};

/*var initMap = function () {
    mapsLoaded = true;
    for(var i in mapsWaiting) {
        mapsWaiting[i]();
    }

    $('.map').each( function(){
        var address = $(this).attr('data-address') ;
        var geocoder = new google.maps.Geocoder();
        geocoder.geocode( { 'address': address}, (function(results, status) {
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
initMap();*/

var initAddressSuggesters;
jQuery(document).ready(function($){
    initAddressSuggesters = function() {
        var step_container = $(this).closest('.step.second');
        prepareMapFunction(function() {
            if($('.address-suggester').length) {
                $('.address-suggester').each( function() {
                    step_container.find('.country-select').change( function() {
                        var cc = $(this).find('option:selected').attr('code');
                        GMautocomplete.setComponentRestrictions({
                            'country': cc
                        });
                    });

                    if( step_container.find('.suggester-map-div').attr('lat') ) {
                        var coords = {
                            lat: parseFloat( step_container.find('.suggester-map-div').attr('lat') ),
                            lng: parseFloat( step_container.find('.suggester-map-div').attr('lon') )
                        };

                        step_container.find('.suggester-map-div').show();
                        var profile_address_map = new google.maps.Map( step_container.find('.suggester-map-div')[0], {
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
                    var cc = step_container.find('.country-select option:selected').attr('value');
                    var options = {
                        componentRestrictions: {
                            country: cc
                        },
                        types: ['address']
                    };

                    var GMautocomplete = new google.maps.places.Autocomplete(input, options);
                    GMautocomplete.step_container = step_container;
                    google.maps.event.addListener(GMautocomplete, 'place_changed', (function () {
                        var place = this.getPlace();

                        this.step_container.find('.address-suggester').blur();
                        this.step_container.find('.geoip-hint').hide();
                        this.step_container.find('.suggester-map-div').hide();

                        if( place && place.geometry ) {
                            //address_components
                            if( place.types.indexOf('street_address')!=-1 || place.types.indexOf('street_number')!=-1 ) {
                                var newaddress = place.name + ', ' + place.vicinity;
                                this.step_container.find('.address-suggester').val(newaddress);

                                prepareMapFunction( (function() {
                                    var coords = {
                                        lat: place.geometry.location.lat(),
                                        lng: place.geometry.location.lng()
                                    };

                                    this.step_container.find('.suggester-map-div').show();
                                    var profile_address_map = new google.maps.Map( this.step_container.find('.suggester-map-div')[0], {
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
                        this.step_container.find('.geoip-hint').show();
                    }).bind(GMautocomplete));
                });
            }
        });

        $('.address-suggester').on('keyup keypress', function(e) {
            var keyCode = e.keyCode || e.which;
            if (keyCode === 13) {
                e.preventDefault();
                return false;
            }

            if($(this).val().trim() == '') {
                step_container.find('.suggester-map-div').hide();
            }
        });
    };

    if($('.address-suggester').length) {
        initAddressSuggesters();
    }
});