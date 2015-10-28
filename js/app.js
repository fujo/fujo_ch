(function($) {
     
    var MT = MT || {},
    
    $win = $(window),
    $doc = $(document),
    $body = $(document.body),

    Modernizr = window.Modernizr,
    isTouch = Modernizr.touch && navigator.userAgent.match(/(iPhone|iPod|iPad)|BlackBerry|Android/);

    FastClick.attach(document.body);
            
    MT = {
        _: function() {	
            this.mobileNav._();
            this.helpers._();
            this.masonry._();
            this.flexslider._();
            this.googlemap._();
        },
        
        mobileNav : {
            _: function() {

                var self = this;

                this.$hb = $(".hamburger");
                this.$mn = $("nav.mobile");

                this._start();

                this.$hb.on('click', function(){
                    $(this).toggleClass('icon-close').toggleClass('icon-bars');
                    self.$mn.slideToggle();
                    return false;
                })

            },
            _start: function() {

                this.$mn.find('.sub').hide();

                this.$mn.on('click', 'span[class^="icon"]', function(){
                    $this = $(this);
                    $this.toggleClass('active');
                    ( $this.hasClass('active') ) ? $this.next().slideDown() : $this.next().slideUp();
                    
                })

            }
        },

        helpers : {
            _: function() {

                var self = this;

                $('#lift').on('click', function(){
                    $('html,body').animate({ scrollTop: 0 }, 'fast');
                    return false;
                })

                $win.on('load resize', self._equalize);

            },
            // equalize elements heights
            _equalize: function() {

                if( $(".equalHeights").lenght < 1 ) return false;

                $(".equalHeights").each(function() {
                    var currentTallest = 0,
                        currentRowStart = 0,
                        currentDiv = 0,
                        rowDivs = new Array(),
                        $this,
                        topPosition = 0;
                    
                    $(this).children().each(function() {
                        var $this = $(this);
                        
                        if ($this.is(':visible')) {
                            $this.height('auto');
                            topPosition = $this.position().top;

                            if (currentRowStart != topPosition) {
                                for (currentDiv = 0; currentDiv < rowDivs.length; currentDiv++) {
                                    rowDivs[currentDiv].height(currentTallest);
                                }
                                rowDivs.length = 0;
                                currentRowStart = topPosition;
                                currentTallest = $this.height();
                                rowDivs.push($this);
                            } else {
                                rowDivs.push($this);
                                currentTallest = (currentTallest < $this.height()) ? ($this.height()) : (currentTallest);
                            }

                            for (currentDiv = 0; currentDiv < rowDivs.length; currentDiv++) {
                                rowDivs[currentDiv].height(currentTallest);
                            }
                        }

                    });                    

                });

            }
                
        },

        responsive: {
            // return current breakpoint

            breakpoints: [
                {
                    device: 'phoneP',
                    minWidth: 0, maxWidth: 567
                },
                {
                    device: 'phoneL',
                    minWidth: 568, maxWidth: 767
                },
                {
                    device: 'tabletP',
                    minWidth: 768, maxWidth: 900
                },
                {
                    device: 'tabletL',
                    minWidth: 901, maxWidth: 1024
                },
                {
                    device: 'desktop',
                    minWidth: 1025
                }
            ],
            _test: function(device) {
                var breakpoints = nator.responsive.breakpoints,
                    winWidth = $(window).width();

                for (var i=0; i<breakpoints.length; i++) {
                    var breakpoint = breakpoints[i];
                    if (breakpoint.maxWidth == undefined || breakpoint.maxWidth >= winWidth && breakpoint.minWidth <= winWidth) {
                        if (device == undefined) return breakpoint.device
                        else {
                            if (device == breakpoint.device) return true;
                            else return false;
                        }
                    }
                }
            }
        },

        masonry : {
            _: function() {

                $win.load( function(){
                    console.log('loaded');
                
                    $('.masonry').masonry({
                        columnWidth: '.masonry--sizer',
                        itemSelector: '.masonry--item'
                    });

                })

            }
        },

        flexslider : {
            options : {
                animation:      "slide",
                slideshow:      true,
                touch:          true,
                controlNav:     true,
                directionNav:   true,
                prevText:       "",
                nextText:       ""  
            },

            _: function() {

                var self = this, options = self.options;

                $win.load(function() {
                    $('.flexslider').flexslider( options );
                });

            }

        },

        googlemap : {
            options : {
                mapOptions: {
                    center: { lat: 47.1714662, lng: 7.3455052 },
                    zoom: 17,
                    minZoom:6,
                    disableDefaultUI: true,
                    panControl: true,
                    keyboardShortcuts: true,
                    zoomControl: true,
                    zoomControlOptions: {
                        // style: google.maps.ZoomControlStyle.SMALL
                        // position: google.maps.ControlPosition.RIGHT_TOP
                    },
                    rotateControl: false,
                    streetViewControl: false,
                    draggable: $doc.width() > 480 ? true : false, // otherwise blocked on the map
                    panControl: false,
                    scrollwheel: false,
                    // mapTypeId: google.maps.MapTypeId.ROADMAP,
                    //styles:[{"featureType":"all","elementType":"labels.text.fill","stylers":[{"saturation":36},{"color":"#000000"},{"lightness":40}]},{"featureType":"all","elementType":"labels.text.stroke","stylers":[{"visibility":"on"},{"color":"#000000"},{"lightness":16}]},{"featureType":"all","elementType":"labels.icon","stylers":[{"visibility":"off"}]},{"featureType":"administrative","elementType":"geometry.fill","stylers":[{"color":"#000000"},{"lightness":20}]},{"featureType":"administrative","elementType":"geometry.stroke","stylers":[{"color":"#000000"},{"lightness":17},{"weight":1.2}]},{"featureType":"administrative","elementType":"labels","stylers":[{"visibility":"off"}]},{"featureType":"administrative.country","elementType":"all","stylers":[{"visibility":"simplified"}]},{"featureType":"administrative.country","elementType":"geometry","stylers":[{"visibility":"simplified"}]},{"featureType":"administrative.country","elementType":"labels.text","stylers":[{"visibility":"simplified"}]},{"featureType":"administrative.province","elementType":"all","stylers":[{"visibility":"off"}]},{"featureType":"administrative.locality","elementType":"all","stylers":[{"visibility":"simplified"},{"saturation":"-100"},{"lightness":"30"}]},{"featureType":"administrative.neighborhood","elementType":"all","stylers":[{"visibility":"off"}]},{"featureType":"administrative.land_parcel","elementType":"all","stylers":[{"visibility":"off"}]},{"featureType":"landscape","elementType":"all","stylers":[{"visibility":"simplified"},{"gamma":"0.00"},{"lightness":"74"}]},{"featureType":"landscape","elementType":"geometry","stylers":[{"color":"#000000"},{"lightness":20}]},{"featureType":"landscape.man_made","elementType":"all","stylers":[{"lightness":"3"}]},{"featureType":"poi","elementType":"all","stylers":[{"visibility":"off"}]},{"featureType":"poi","elementType":"geometry","stylers":[{"color":"#000000"},{"lightness":21}]},{"featureType":"road","elementType":"geometry","stylers":[{"visibility":"simplified"}]},{"featureType":"road.highway","elementType":"geometry.fill","stylers":[{"color":"#000000"},{"lightness":17}]},{"featureType":"road.highway","elementType":"geometry.stroke","stylers":[{"color":"#000000"},{"lightness":29},{"weight":0.2}]},{"featureType":"road.arterial","elementType":"geometry","stylers":[{"color":"#000000"},{"lightness":18}]},{"featureType":"road.local","elementType":"geometry","stylers":[{"color":"#000000"},{"lightness":16}]},{"featureType":"transit","elementType":"geometry","stylers":[{"color":"#000000"},{"lightness":19}]},{"featureType":"water","elementType":"geometry","stylers":[{"color":"#000000"},{"lightness":17}]}]
                        //styles:[{"stylers":[{"visibility":"simplified"}]},{"stylers":[{"color":"#131314"}]},{"featureType":"water","stylers":[{"color":"#131313"},{"lightness":7}]},{"elementType":"labels.text.fill","stylers":[{"visibility":"on"},{"lightness":25}]}]
                    styles:[ {"featureType": "administrative", "elementType": "labels.text.fill", "stylers": [{"color": "#444444"} ] }, {"featureType": "landscape", "elementType": "all", "stylers": [{"color": "#f2f2f2"} ] }, {"featureType": "poi", "elementType": "all", "stylers": [{"visibility": "off"} ] }, {"featureType": "road", "elementType": "all", "stylers": [{"saturation": -100 }, {"lightness": 45 } ] }, /* {"featureType": "road.highway", "elementType": "all", "stylers": [{"visibility": "simplified"} ] }, {"featureType": "road.arterial", "elementType": "labels.icon", "stylers": [{"visibility": "off"} ] },   {"featureType": "transit", "elementType": "all", "stylers": [{"visibility": "off"} ] },  */ { "featureType": "water", "elementType": "labels", "stylers": [ { "visibility": "off" } ] }, {"featureType": "water", "elementType": "all", "stylers": [{"color": "#116CB5"},  {"visibility": "on"} ] }, { "featureType": "water", "elementType": "labels", "stylers": [ { "visibility": "off" } ] } ] }
            },

            _: function() {
                
                if( !$('#map').length ) return false;

                var options = this.options, self = this;

                this.map;
                this.marker;
                this.markers = new Array();

                this.map = new google.maps.Map(document.getElementById('map'), options.mapOptions);
                google.maps.event.addDomListener(window, 'load');

                var myLatlng = new google.maps.LatLng( 47.1714662, 7.3455052 );

                this._addMarker(myLatlng, 'title');

            },

            _addMarker: function(myLatlng,title) {

                var iconSVG = {     
                    path: 'M183,260.5c-59.1,0-107,47.9-107,107c0,25.4,8.8,48.7,23.6,67c17.9,22.3,56.5,42.3,64.1,130.7c0,5.2,3.2,16.1,19.3,16.1 c16.1,0,19.6-10.9,19.6-16.1c7.7-88.4,45.9-108.5,63.8-130.7c14.8-18.3,23.6-41.6,23.6-67C290,308.4,242.1,260.5,183,260.5z M181.3,402.2c-19.1,0-34.6-15.5-34.6-34.6c0-19.1,15.5-34.6,34.6-34.6c19.1,0,34.6,15.5,34.6,34.6 C215.9,386.7,200.4,402.2,181.3,402.2z', fillColor: 'gold', fillOpacity: 1,
                    scale: 0.2,
                    anchor: new google.maps.Point( 214 , 500),
                    strokeColor: '#116CB5',
                    fillColor: '#FFA630',     
                    strokeWeight: 0 
                };

                this.marker = new google.maps.Marker({
                     position: myLatlng,
                     title: title,
                     icon: iconSVG
                });

                google.maps.event.addListener(this.marker, 'click', function() {
                    //window.location.href = "";
                    window.open(
                          'https://www.google.ch/maps/dir//Metaltec+AG,+B%C3%BCrenstrasse,+Perles/',
                          '_blank' // <- This is what makes it open in a new window.
                        );
                });

                this.marker.setMap(this.map);
                this.markers.push(this.marker); 
                
            },

            _fitToMarkers: function() {

                var markers = this.markers;
                var bounds = new google.maps.LatLngBounds();

                for(i=0;i<markers.length;i++) {
                    bounds.extend(markers[i].getPosition());
                }

                this.map.fitBounds(bounds);

            }

        }

   	},  
       
    MT._();

})(jQuery);