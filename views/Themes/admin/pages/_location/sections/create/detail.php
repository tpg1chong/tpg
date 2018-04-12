<?php

$form = new Form();
$form = $form->create()
	->elem('div')->style('horizontal')
	->addClass('pal');

$form   ->field("facilities")
        ->type( 'checkbox' )
        ->name( 'facilities[]' )
        ->items( $this->facilitiesList )
        ->label( 'Facilities' );

/*$form   ->field("options_payment_options")
        ->type( 'checkbox' )
        ->items( $this->paymentList )
        ->label( 'Payment Options' );

$form   ->field("options_transportation")
        ->type( 'checkbox' )
        ->items( $this->transportationList )
        ->label( 'Transportation' );
*/
echo $form->html();
