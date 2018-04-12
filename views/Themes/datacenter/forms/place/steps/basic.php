<?php

$form = new Form();
$form = $form->create()
	->elem('div')->style('horizontal')
	->addClass('pal');

$form   ->field("building_type")
        ->name( 'building[type]' )
        ->label( 'Property Type' )
        ->autocomplete('off')
        ->addClass('inputtext')
        ->select(  $this->typeList );

$form   ->field("building_name")
        ->name( 'building[name]' )
        ->label('Name')
        ->autocomplete('off')
        ->addClass('inputtext');

$form   ->field("building_description")
        ->name( 'building[description]' )
        ->label('Description')
        ->autocomplete('off')
        ->addClass('inputtext')
        ->type( 'textarea' );


$body .= $form->html();
