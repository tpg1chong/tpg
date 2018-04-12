<?php

$form = new Form();
$form = $form->create()
	->elem('div')->style('horizontal')
        ->attr( 'data-plugins', 'formLocation' )
	->addClass('pal');

$form   ->field("location_country")
        ->name( 'location[country]' )
        ->label( 'ประเทศ' )
        ->autocomplete('off')
        ->addClass('inputtext')
        ->select( $this->countryList, 'id', 'name', false );

$form   ->field("location_province")
        ->name( 'location[province]' )
        ->label('จังหวัด')
        ->autocomplete('off')
        ->addClass('inputtext')
        ->select( array() );

$form   ->field("location_zone")
        ->name( 'location[zone]' )
        ->label('อำเภอ/เขต')
        ->autocomplete('off')
        ->addClass('inputtext')
        ->select( array() );

$form   ->field("location_district")
        ->name( 'location[district]' )
        ->label('ตำบล/แขวง')
        ->autocomplete('off')
        ->addClass('inputtext')
        ->select( array() );

$form   ->field("location_address")
        ->name( 'location[address]' )
        ->label('ที่อยู่')
        ->autocomplete('off')
        ->addClass('inputtext')
        ->type('textarea');


/*$form   ->field("location_road")
        ->name( 'location[road]' )
        ->label('ถนน')
        ->autocomplete('off')
        ->addClass('inputtext');

$form   ->field("location_soi")
        ->name( 'location[soi]' )
        ->label('ซอย')
        ->autocomplete('off')
        ->addClass('inputtext');

$form   ->field("location_moo")
        ->name( 'location[moo]' )
        ->label('หมู่ที่')
        ->autocomplete('off')
        ->addClass('inputtext');

$form   ->field("location_address")
        ->name( 'location[address]' )
        ->label('บ้านเลขที่')
        ->autocomplete('off')
        ->addClass('inputtext');*/

echo $form->html();
