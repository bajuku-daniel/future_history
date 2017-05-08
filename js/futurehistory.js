(function ($) {
    $(function () {
        var cookie_data = [];

        function nextItem(i, arr) {
            i = i + 1; // increase i by one
            i = i % arr.length; // if we've gone too high, start from `0` again
            return arr[i]; // give us back the item of where we are now
        }

        function prevItem(i, arr) {
            if (i === 0) { // i would become 0
                i = arr.length; // so put it at the other end of the array
            }
            i = i - 1; // decrease by one
            return arr[i]; // give us back the item of where we are now
        }

        function initialize() {
            cookie_data = JSON.parse($.cookie("fh_state_cookie"));

            if ($(".node-type-ansicht .ansicht-back-to-map").size() > 0) {
                // clickhandler sets cookie to reinitialize previous map/filter settings
                // TODO: check URL via config e.g. multilanguage case
                // needed to activate popstate listening
                try {
                    history.pushState({}, '', window.location);
                    history.back();
                } catch (err) {
                }

                var referrer = document.referrer;

                if ((referrer.indexOf("fh-entdecken-map") !== -1)) {
                    if ((cookie_data) && (cookie_data.initializeOnPageLoad !== 'undefined' || cookie_data.initializeOnPageLoad !== null)) {
                        cookie_data.initializeOnPageLoad = true;
                        $.cookie('fh_state_cookie', JSON.stringify(cookie_data), {path: '/'});
                        cookie_data = JSON.parse($.cookie("fh_state_cookie"));
                    }
                }

                // update URL of "Zur Karte" button only if referrer is NOT map
                var origin = document.referrer;
                if ($('#ansicht_lat').val() && (origin.indexOf("fh-entdecken-map") === -1)) {
                    var requestDate = "1644--2016";
                    var zoom = "15";
                    var url_update = "/de/fh-entdecken-map?y=" + $('#ansicht_lat').val() + "&x=" + $('#ansicht_lng').val() + "&z=" + zoom + "&k=&d=" + requestDate + "&a=all&s=dist";
                    $(".ansicht-back-button").attr("href", url_update);
                }
            }

            if (typeof cookie_data.lastResults !== 'undefined') {
                // invalidation of current filter results for certain pages by css selectors
                $(".front,.page-node-add,.page-user,.page-user-meine-ansichten,.page-user-sammlungen,.page-user-touren").each(function () {
                    cookie_data.lastResults = 'undefined';
                    // delete cookie_data[lastResults];
                    $.cookie('fh_state_cookie', JSON.stringify(cookie_data), {path: '/'});
                });
            }

            var splitUrl = window.location.href.split("/");
            currentNid = splitUrl.slice(-1)[0];
            console.log(splitUrl);
            if(currentNid.indexOf("#") !== -1){
                currentNid = currentNid.substr(0,currentNid.indexOf("#"));
            }

            if (typeof cookie_data.lastResults !== 'undefined') {
                // build data for sliding next/prev images based on last results
                var currentIndex = cookie_data.lastResults.indexOf(currentNid);
                var nextNid = nextItem(currentIndex, cookie_data.lastResults);
                var prevNid = prevItem(currentIndex, cookie_data.lastResults);

                if ($.isNumeric(nextNid) && $.isNumeric(prevNid)) {
                    $(".count").text((currentIndex + 1) + "/" + (cookie_data.lastResults.length));
                    $(".prev-button").removeClass('hidden').attr("href", "/node/" + prevItem(currentIndex, cookie_data.lastResults));
                    $(".next-button").removeClass('hidden').attr("href", "/node/" + nextItem(currentIndex, cookie_data.lastResults));
                    $(document).keydown(function(e){
                        switch(e.which) {
                            case $.ui.keyCode.LEFT:
                                console.log($.ui.keyCode.LEFT);
                                $(".prev-button")[0].click();
                                break;
                            case $.ui.keyCode.RIGHT:
                                console.log($.ui.keyCode.RIGHT);
                                $(".next-button")[0].click();
                                break;

                            default: return; // allow other keys to be handled
                        }
                        e.preventDefault();
                    });
                }
            }
        }

        initialize();
    });
    // Style the gmap markers blue and violet
    var fh_marker_blue = new google.maps.MarkerImage(
        '/sites/default/files/gmap-files/fh-poi-blue.png',
        new google.maps.Size(25, 25),
        new google.maps.Point(0, 0), //origin
        new google.maps.Point(12, 12) //anchor point
    );

    var fh_marker_violet = new google.maps.MarkerImage(
        '/sites/default/files/gmap-files/fh-poi-violet.png',
        new google.maps.Size(25, 25),
        new google.maps.Point(0, 0), //origin
        new google.maps.Point(12, 12) //anchor point
    );

    var tour_url = '/de/fh_view/list_tour_content';
    var pois_by_nid = [];
    var mapCenter;
    var allTourMarker = [];

    var maxTourDistance = 10000;

    function showTourOnMap(tour_id, tourname) {
        tour_id = typeof tour_id !== 'undefined' ? tour_id : '14';
        tourname = typeof tourname !== 'undefined' ? tourname : '';

        // start the ajax request to get tour details
        $.ajax({
            url: tour_url,
            method: 'get',
            data: "tour_id=" + tour_id,
            dataType: 'json',
            success: function (tourdata) {
                var original_tourdata = [];
                for (item in tourdata) {
                    if ('nid' in tourdata[item]) {
                        original_tourdata.push(tourdata[item]);
                    }
                }

                var directionsService = new google.maps.DirectionsService;
                var directionsDisplay = new google.maps.DirectionsRenderer;

                directionsDisplay.setMap(Drupal.futurehistoryTourMap.map);
                directionsDisplay.setOptions({suppressMarkers: true});

                calculateAndDisplayRoute(directionsService, directionsDisplay, original_tourdata);
            }
        });
    }

    function calculateAndDisplayRoute(directionsService, directionsDisplay, original_tourdata) {
        var waypts = [];
        var tour_pois = [];
        var initTourDistance = $('#tour_distance').html();

        for (var i = 0; i < original_tourdata.length; i++) {
            if (i === 0) {
                // Start EndPunkt benötigen Datenformat mit lng/lat oder Text e.g. New York,US
                my_origin = original_tourdata[i]['lat'] + "," + original_tourdata[i]['lng'];

                //create the array for our tour pois
                tour_pois.push({
                    lat: original_tourdata[i]['lat'],
                    lng: original_tourdata[i]['lng'],
                    nid: original_tourdata[i]['nid']
                });
                // overwrite with 0 in next step - than we have a tour - otherway we have a single poi :)
                var one_poi = 1;

            } else if (i === original_tourdata.length - 1) {
                my_destination = original_tourdata[i]['lat'] + "," + original_tourdata[i]['lng'];
                tour_pois.push({
                    lat: original_tourdata[i]['lat'],
                    lng: original_tourdata[i]['lng'],
                    nid: original_tourdata[i]['nid']
                });
                one_poi = 0;
            } else {
                // waypoints benörigen datenformat mit folgender Struktur info
                waypts.push({
                    location: new google.maps.LatLng(original_tourdata[i]['lat'], original_tourdata[i]['lng']),
                    stopover: true
                });
                tour_pois.push({
                    lat: original_tourdata[i]['lat'],
                    lng: original_tourdata[i]['lng'],
                    nid: original_tourdata[i]['nid']
                });
            }
        }
        // check if we have more than one poi in our tour
        if (one_poi == 0) {
            if (initTourDistance < maxTourDistance) {
                directionsService.route({
                    origin: my_origin,
                    destination: my_destination,
                    waypoints: waypts,
                    optimizeWaypoints: false,
                    travelMode: google.maps.TravelMode.WALKING
                }, function (response, status) {
                    if (status === google.maps.DirectionsStatus.OK) {
                        directionsDisplay.setDirections(response);
                    } else {
                        window.alert('Directions request failed due to ' + status);
                    }
                });
            }
            else {
                $('#tour_distance').html(' > 10000 ')

            }

        } else {
            var poiPosition = new google.maps.LatLng(tour_pois[0]['lat'], tour_pois[0]['lng']);
            Drupal.futurehistoryTourMap.map.panTo(poiPosition);
        }


        for (var i = 0; i < tour_pois.length; i++) {
            var poiPosition = new google.maps.LatLng(tour_pois[i]['lat'], tour_pois[i]['lng']);
            var poiId = tour_pois[i]['nid'];
            Drupal.futurehistoryTourMap.marker = new google.maps.Marker({
                position: poiPosition,
                map: Drupal.futurehistoryTourMap.map,
                icon: fh_marker_blue,
                id: poiId,
            });

            //add the marker hover listner
            google.maps.event.addListener(Drupal.futurehistoryTourMap.marker, 'mouseover', function () {
                hoverThumb('hover', this.id);
                hoverMarker('hover', this.id);
            });
            google.maps.event.addListener(Drupal.futurehistoryTourMap.marker, 'mouseout', function () {
                hoverThumb('out', this.id);
                hoverMarker('out', this.id);
            });

            //put all markers in our tour array
            allTourMarker.push(Drupal.futurehistoryTourMap.marker);

            var bounds = new google.maps.LatLngBounds();
            for (var c = 0; c < allTourMarker.length; c++) {
                bounds.extend(allTourMarker[c].getPosition());
            }
            Drupal.futurehistoryTourMap.map.fitBounds(bounds);
        }
    }

    // hover the thumnail images
    function hoverThumb(action, id) {
        var elementToChange = $('#' + id).closest('.views-row').find('img');
        if (action == 'hover') {
            elementToChange.css('box-shadow', '3px 3px 4px #992683');
        } else {
            elementToChange.css('box-shadow', 'none');
        }
    }

    // hover the map marker
    function hoverMarker(action, id) {
        for (var i = 0; i < allTourMarker.length; i++) {
            if (id === allTourMarker[i].id) {
                if (action == 'hover') {
                    allTourMarker[i].setIcon(fh_marker_violet);
                    break;
                }
                else {
                    allTourMarker[i].setIcon(fh_marker_blue);
                    break;
                }
            }
        }
    }

    //Start drupal behaviors for tour map
    Drupal.behaviors.futurehistoryTourMap = {
        attach: function (context, settings) {
            var tour_id = $('#tour_id').val();

            // Touren Map STUFF
            $('#fh-touren-detail-map', context).each(function () {
                var $this = $(this);

                Drupal.futurehistoryTourMap = {};
                mapZoom = 16;

                if (mapCenter == undefined) {
                    var initial_center_lat = 51.31491849367987;
                    var initial_center_lng = 9.460614849999956;
                    mapCenter = new google.maps.LatLng(initial_center_lat, initial_center_lng);
                    mapZoom = 6;
                }

                Drupal.futurehistoryTourMap.map = new google.maps.Map(this, {
                    center: mapCenter,
                    zoom: mapZoom,
                    mapTypeId: google.maps.MapTypeId.ROADMAP,
                    mapTypeControl: false,
                    zoomControl: true,
                    streetViewControl: false,
                    rotateControl: false,
                    scrollwheel: false,
                });

                // set tilt to 0 and stop rotatign the map
                Drupal.futurehistoryTourMap.map.setTilt(0);

                showTourOnMap(tour_id);

                //hover the pois function
                var poi_id;
                $('.view-flag-lists-user-list .views-row').find('img').mouseover(function () {
                    poi_id = $(this).closest('.views-row').find('.tour_id_container').attr('id');
                    hoverMarker('hover', poi_id);
                    hoverThumb('hover', poi_id);

                }).mouseout(function () {
                    hoverMarker('out', poi_id);
                    hoverThumb('out', poi_id);
                });

            }); // end MAP each function

        }  // end beaviors and atach function
    }


    //Start drupal behaviors
    Drupal.behaviors.futurehistoryDetails = {
        attach: function (context, settings) {

            // div once funciton for the click events in the action navigation
            // open and close the toggles and start and stop the audio
            $('.ansicht-details-aktion').once(function () {
                $(".ansicht-audio-button").click(function () {
                    $(".audio-container").slideToggle("slow");
                    $('#ansicht-audio-player').trigger("play");
                });
                $(".ansicht-share-button").click(function () {
                    $(".share-container").slideToggle("slow");
                });
                $(".ansicht-collection-button-message").click(function () {
                    $(".collection-container").slideToggle("slow");
                });
                $(".audio-close").click(function () {
                    $(".audio-container").slideUp("fast");
                    $('#ansicht-audio-player').trigger("pause");
                });
                $(".share-close").click(function () {
                    $(".share-container").slideUp("fast");
                });
            });

            // get the geo variables out of the hidden input fields in the node--ansicht.tpl.php files
            var lat = $('#ansicht_lat').val();
            var lng = $('#ansicht_lng').val();
            var angle = parseInt($('#ansicht_angle').val());
            var heading = parseInt($('#ansicht_direction').val());
            // make new Latlng object
            var standpunkt = new google.maps.LatLng(lat, lng);


            // Overview MAP STUFF
            $('#ansicht-overview-map', context).each(function () {
                var $this = $(this);

                Drupal.futurehistoryDetails = {};
                mapCenter = new google.maps.LatLng(lat, lng);
                mapZoom = 16;

                Drupal.futurehistoryDetails.map = new google.maps.Map(this, {
                    center: mapCenter,
                    zoom: mapZoom,
                    mapTypeId: google.maps.MapTypeId.SATELLITE,
                    mapTypeControl: false,
                    zoomControl: true,
                    streetViewControl: false,
                    rotateControl: false,
                    scrollwheel: false,
                });
                // set tilt to 0 and stop rotatign the map
                Drupal.futurehistoryDetails.map.setTilt(0);

                // set the ansicht_marker
                Drupal.futurehistoryDetails.marker = new google.maps.Marker({
                    position: standpunkt,
                    map: Drupal.futurehistoryDetails.map,
                    icon: fh_marker_violet,
                });

                // if angle is more than 0 print the "blickwinkel PIE"
                if (angle != 0) {
                    var lineSymbol = {
                        path: google.maps.SymbolPath.FORWARD_OPEN_ARROW
                    };

                    var distance = 300;
                    var half_openangle = angle / 2;

                    var point_a = google.maps.geometry.spherical.computeOffset(standpunkt, distance, heading - half_openangle);
                    var point_b = google.maps.geometry.spherical.computeOffset(standpunkt, distance, heading + half_openangle);

                    line_a = new google.maps.Polyline({
                        path: [standpunkt, point_a],
                        icons: [{
                            icon: lineSymbol,
                            offset: '100%'
                        }],
                        map: Drupal.futurehistoryDetails.map,
                    });

                    line_b = new google.maps.Polyline({
                        path: [standpunkt, point_b],
                        icons: [{
                            icon: lineSymbol,
                            offset: '100%'
                        }],
                        map: Drupal.futurehistoryDetails.map,
                    });

                    pie = new google.maps.Polygon({
                        paths: [standpunkt, point_a, point_b],
                        strokeColor: '#9E1F81',
                        strokeOpacity: 0.6,
                        strokeWeight: 1,
                        fillColor: '#9E1F81',
                        fillOpacity: 0.45,
                        map: Drupal.futurehistoryDetails.map,
                    });
                }

            }); // end MAP each function

        }  // end beaviors and atach function
    }

})(jQuery);
