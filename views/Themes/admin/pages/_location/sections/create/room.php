<?php

$form = new Form();
$form = $form->create()
	->elem('div')->style('horizontal')
	->addClass('pal');

$form   ->field("rooms")
        ->name( 'rooms[]' )
        ->label( 'Room Type' )
        ->autocomplete('off')
        ->addClass('inputtext')
        ->select( $this->roomTypeList );


echo $form->html();