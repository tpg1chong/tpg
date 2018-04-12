<?php

$form = new Form();
$form = $form->create()
	->elem('div')
    ->style('horizontal')
    ->attr( 'data-plugins', 'formLocation' )
	->addClass('pal form-insert form-location signin-screen');

$form   ->field("location_country")
        ->name( 'location[country]' )
        ->label( 'Country / Region' )
        ->autocomplete('off')
        ->addClass('inputtext')
        ->select( $this->countryList, 'id', 'name', false );

$form   ->field("location_address")
        ->name( 'location[address]' )
        ->label('Street address')
        ->attr( 'data-plugins', 'autosize' )
        ->autocomplete('off')
        ->addClass('inputtext')
        ->type('textarea');


$form   ->field("location_zone")
        ->name( 'location[zone]' )
        ->label('Amphoe / Khet')
        ->autocomplete('off')
        ->addClass('inputtext')
        ->select( array() );

$form   ->field("location_district")
        ->name( 'location[district]' )
        ->label('Tambon / Khwaeng')
        ->autocomplete('off')
        ->addClass('inputtext')
        ->select( array() );

/*$form   ->field("location_road")
        ->name( 'location[road]' )
        ->label('ถนน')
        ->autocomplete('off')
        ->addClass('inputtext');*/

/*$form   ->field("location_soi")
        ->name( 'location[soi]' )
        ->label('ซอย')
        ->autocomplete('off')
        ->addClass('inputtext');*/


/*$form   ->field("location_number")
        ->name( 'location[number]' )
        ->label('บ้านเลขที่')
        ->autocomplete('off')
        ->addClass('inputtext');*/

$form   ->field("location_province")
        ->name( 'location[province]' )
        ->label('Province')
        ->autocomplete('off')
        ->addClass('inputtext')
        ->select( array() );

$form   ->field("location_postal")
        ->name( 'location[postal]' )
        ->label('Postal code')
        ->autocomplete('off')
        ->addClass('inputtext');

$form   ->field("location_latitude")
        ->name( 'location[latitude]' )
        ->label('Latitude')
        ->autocomplete('off')
        ->addClass('inputtext');

$form   ->field("location_longitude")
        ->name( 'location[longitude]' )
        ->label('Longitude')
        ->autocomplete('off')
        ->addClass('inputtext');



/*


$form   ->field("location_address")
        ->name( 'location[address]' )
        ->label('บ้านเลขที่')
        ->autocomplete('off')
        ->addClass('inputtext');*/

$body .= '<div style="position: absolute;top: 120px;left: 30px;z-index: 10;background-color: rgba(255, 255, 255, 0.9);box-shadow: 0 2px 3px rgba(0,0,0,.3);padding: 10px 0;border-radius: 5px;max-width: 412px;">'.$form->html().'</div>'.

'<div style="position: absolute;top: 98px;left: 1px;right: 1px;bottom: 55px;">'.

    '<div id="map" style="width: 100%;height: 100%;"></div>'.
    /*'<table><tbody><tr>'.
            '<td><input type="text" class="inputtext" id="latitude" name="latitude" autocomplete="off" placeholder="Latitude.." value="'.(!empty($this->item['latitude']) ? $this->item['latitude'] : '').'" /></td>'.
            '<td><input type="text" class="inputtext" id="longitude" name="longitude" autocomplete="off" placeholder="Longitude.." value="'.(!empty($this->item['longitude']) ? $this->item['longitude'] : '').'" /></td>'.
    '</tr></tbody></table>'.*/

'</div>'.

'<script>

    var uluru = {
        lat: parseFloat( $(\'#location_latitude\').val() ) || 13.761583069404265, 
        lng: parseFloat( $(\'#location_longitude\').val() ) || 100.50811657094732
    };

    function initMap() {

        var center = {
            lat: uluru.lat,
            lng: uluru.lng - 0.007
        }

        var map = new google.maps.Map(document.getElementById(\'map\'), {
            zoom: 15,
            center: center,

            navigationControl: false,
            mapTypeControl: false,
            scaleControl: false,

            scrollwheel: false,
            disableDoubleClickZoom: true,
        });

        var marker = new google.maps.Marker({
            position: uluru,
            map: map,

            draggable: true,
        });


        marker.addListener(\'dragend\', function( evt ) {
            $(\'#location_latitude\').val( evt.latLng.lat() );
            $(\'#location_longitude\').val( evt.latLng.lng() );
        });

    }
    </script>
    <script async defer src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDt1-iJi7cO8S6S7Qtolxm9JnSi39sbnnc&callback=initMap"></script>'.

'';
