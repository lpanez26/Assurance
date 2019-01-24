console.log("WTFF");
var mapsLoaded = true;
var mapsWaiting = [];

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

initMap();




var initAddressSuggesters;

jQuery(document).ready(function($){

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