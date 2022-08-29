'use strict';

const page = document.querySelector('html, body');
let locationsBAM = [];
let locationsHP = [];
const jsonDataFiles = {
    'HP': {
        'fileURL': hpGlobals.hpJsonURL,
        'locationsArray': locationsHP
    },
    'BAM': {
        'fileURL': hpGlobals.bamJsonURL,
        'locationsArray': locationsBAM
    }
};

(function ($) {

    // Get map locations from JSON files
    for (let key in jsonDataFiles) {
        let file = jsonDataFiles[key];
        $.getJSON(file.fileURL, function(data) {
            $.each(data, function(key, val) {
                file.locationsArray.push(val);
            });
        });
    }

    // Scroll To Target Function
    $('.scroll').on('click', function(e) {
        e.preventDefault();
        let target = $(this).data('target');        
        let speed = 800;
        let offset = 80;
        if (target === '#map') {
            speed = 1;
            offset = 350;
        }
        $('html, body').animate({
            scrollTop: $(target).offset().top - offset
        }, speed);
    });

})(jQuery);

window.onload = function() {

    // Header video lazy load
    const headerVideo = document.querySelector('.header__video video');
    if (headerVideo !== null) headerVideo.play();

    // Hangarts images lazy load
    // const hangartsImages = document.querySelectorAll('.hangart__img');
    // for (let i = 0; i < hangartsImages.length; i++) {
    //     let img = hangartsImages[i];
    //     setTimeout(function(){
    //         img.src = img.dataset['src'];
    //         img.srcset = img.dataset['srcset'];
    //     }, 200);
    // }
    
    // Back to top button
    const backToTop = document.getElementById("back-to-top");
    window.addEventListener('scroll', function() {
        let windowTop = window.pageYOffset;        
        if (windowTop > 800) {
            backToTop.classList.add("active");
        } else {
            backToTop.classList.remove("active");
        }
    });
    backToTop.addEventListener("click", function(e) {
        e.preventDefault();
        window.scroll({
            top: 0,
            left: 0,
            behavior: "smooth",
        });
    });
    
};

// Google Map
window.addEventListener(
    "resize",
    function() {
        setTimeout(initMap(), 1000);
    },
    true
);

let markerCategories = { 'hp': true, 'bam': true };

function initMap() {

    setTimeout(function(){

        let mapZoom = 11;
        if (window.innerWidth <= 900) mapZoom = 10;

        const mapTypeStyles = [{
            featureType: "all",
            elementType: "labels.text.fill",
            stylers: [
                {
                    color: "#124c3c",
                    
                },
            ],
            
        }, ];

        const mapOptions = {
            center: {
                lat: 46.4155250,
                lng: -72.969765
            },
            zoom: mapZoom,
            mapTypeId: "roadmap",
            mapTypeControl: false,
            styles: mapTypeStyles,
            backgroundColor: '#fff'            
        };
        
        const googleMap = new google.maps.Map(document.getElementById("map"), mapOptions);

        let markerOptions,
            marker,
            infoWindow,
            infoWindowContent;
  
        let locationsDataHP = {
            'data': locationsHP,
            'icon': hpGlobals.iconURL + 'icon-map-hangart.png',
            'color': '#994488',
            'suffix': 'hp'
        };
        let locationsDataBAM = {
            'data': locationsBAM,
            'icon': hpGlobals.iconURL + 'icon-map-bam.png',
            'color': '#124c3c',
            'suffix': 'bam'
        };
        let locations = [];
        if (markerCategories.hp) locations.push(locationsDataHP);
        if (markerCategories.bam) locations.push(locationsDataBAM);

        for (let key in locations) {
            let locationsData = locations[key];
            let markerIcon = locationsData.icon;
            /*
            if (window.devicePixelRatio > 1.1) {
                let markerIconExt = markerIcon.substr(markerIcon.length - 4);
                let markerIconFileName = markerIcon.replace(markerIconExt, '', markerIcon);
                markerIcon = markerIconFileName + '-2x' + markerIconExt;
            }
            */
            
            for (let location of locationsData.data) {
                
                markerOptions = {
                    position: new google.maps.LatLng(location.lat, location.lng),
                    optimized: false,
                    //size: new google.maps.Size(40, 40),
                    //scaledSize: new google.maps.Size(40, 40),
                    // animation: google.maps.Animation.DROP,
                };
                marker = new google.maps.Marker(markerOptions);
                marker.setMap(googleMap);
                // marker.setLabel(location.title);
                marker.setIcon(markerIcon);
        
                infoWindow = new google.maps.InfoWindow();
        
                (function(marker, location) {
                    google.maps.event.addListener(marker, "click", function(e) {
                        infoWindowContent = "<div class='marker marker--" + locationsData.suffix + "' style='width:150px;min-height:100px'>";
                        infoWindowContent += "<h4 class='marker__title marker__title--" + locationsData.suffix + "'>" + location.title + "</h4>";
                        infoWindowContent += "<a class='marker__address' href='" + location.gmap + "' target='_blank'>" + location.address + "</a>";
                        infoWindowContent += "<a class='marker__phone' href='tel:+1" + location.phone.replace(/\-|\s/g, "") + "'>" + location.phone + "</a>";
                        infoWindowContent += "<a class='marker__website' href='" + location.website + "' target='_blank'>En savoir plus</a>";
                        infoWindowContent += "</div>";
                        infoWindow.setContent(infoWindowContent);
                        infoWindow.open(googleMap, marker);
                    });
                })(marker, location);

            }

        }

    });

}

// Google Map Filters
const filters = document.querySelectorAll('.filter');
for (let i = 0; i < filters.length; i++) {
    filters[i].addEventListener('click', function(){
        let cat = filters[i].dataset.cat;
        let checkbox = filters[i].querySelector('.filter__checkbox');
        if (!markerCategories[cat]) {
            markerCategories[cat] = true;
            checkbox.classList.remove('unchecked');
        } else {
            markerCategories[cat] = false;
            checkbox.classList.add('unchecked');
        }
        initMap();
    });
    
}