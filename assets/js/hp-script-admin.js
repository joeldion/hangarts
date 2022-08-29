'use strict';

window.onload = function() {
    
    // Get coordinates
    const hpAddress = document.getElementById('hp-hangart-address');
    const hpCity = document.getElementById('hp-hangart-city');
    const hpPostalCode = document.getElementById('hp-hangart-postal-code');
    const hpAddressFields = document.querySelectorAll( '#hp-hangart-address, #hp-hangart-city, #hp-hangart-postal-code' );
    const hpCoord = document.getElementById('hp-hangart-coord');
    let geocoder = new google.maps.Geocoder();

    function getCoord() {

        const hpFullAddress = hpAddress.value + ', ' + hpCity.value + ' ' + hpPostalCode.value + ' QC Canada';

        geocoder.geocode({
            'address': hpFullAddress,
        }, function(results) {
            let coord = results[0].geometry.viewport;
            let latObj = Object.values(coord)[0];
            let lngObj = Object.values(coord)[1];
            let lat = Object.values(latObj)[0];
            let lng = Object.values(lngObj)[1];
            let hpCoordValue = lat + ',' + lng;
            hpCoord.setAttribute('value', hpCoordValue);              
        });

    }

    getCoord();

    for (let i = 0; i < hpAddressFields.length; i++) {
        hpAddressFields[i].addEventListener('change', function(){
            getCoord();
        });
    }

}

/*
 * Media Uploader
 */
(function ($) {

    let mediaUploader;

    const mediaUploadButtons = document.querySelectorAll('.hp-media-upload');
    for (let i = 0; i < mediaUploadButtons.length; i++) {
        let btn = mediaUploadButtons[i];
        let target = btn.dataset.target;
        let mediaImage = document.getElementById(target);
        let mediaPreview = document.getElementById(target + '-preview');
        let mediaRemoveBtn = document.getElementById(target + '-remove');
        let attachment = '';
        
        btn.addEventListener('click', function(e) {
            e.preventDefault();

            if (mediaUploader) {
                mediaUploader.open();
                return;
            }

            mediaUploader = wp.media.frames.file_frame = wp.media({
                title: 'Choisir une image',
                button: {
                    text: 'Choisir cette image',
                },
                multiple: false,
            });

            mediaUploader.on('select', function () {
                attachment = mediaUploader.state().get('selection').first().toJSON();
                mediaImage.value = attachment.id;
                console.log(mediaImage);
                console.log(attachment.id);
                mediaPreview.style.backgroundImage = 'url(' + attachment.url + ')';
                mediaPreview.classList.add('visible');
                mediaRemoveBtn.classList.add('visible');
            });
    
            mediaUploader.open();            

        });

        mediaRemoveBtn.addEventListener('click', function (e) {
            e.preventDefault();
            mediaImage.value = '';
            mediaPreview.style.backgroundImage = 'url()';
            mediaPreview.classList.remove('visible');
            mediaRemoveBtn.classList.remove('visible');
        });

    }

})(jQuery);