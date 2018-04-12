<?php

# title
$title = 'Room Offer';

if( !empty($this->item) ){
    $arr['title']= $title;
    $arr['hiddenInput'][] = array('name'=>'id','value'=>$this->item['id']);
}
else{
    $arr['title']= $title;
}


$form = new Form();
$form = $form->create()
	// set From
	->elem('div')
	->addClass('form-insert');


$form   ->field("offer_category_id")
        ->label( 'Category*' )
        ->autocomplete('off')
        ->addClass('inputtext')
        ->select( $this->categoryList, 'id', 'name', false )
        ->value( !empty($this->item['category_id'])? $this->item['category_id']:'' );

$form   ->field("offer_type_id")
        ->label( 'Type*' )
        ->autocomplete('off')
        ->addClass('inputtext')
        ->select( $this->typesList )
        ->value( !empty($this->item['type_id'])? $this->item['type_id']:'' );

$form 	->field("offer_name")
    	->label( 'Name*' )
        ->autocomplete('off')
        ->addClass('inputtext')
        ->placeholder('')
        ->attr('autofocus', 1)
        ->value( !empty($this->item['name'])? $this->item['name']:'' );

# set form
$arr['form'] = '<form class="js-submit-form" method="post" action="'.URL. 'property/save/room_offers/"></form>';

# body
$arr['body'] = $form->html();

# fotter: button
$arr['button'] = '<button type="submit" class="btn btn-primary btn-submit"><span class="btn-text">Save</span></button>';
$arr['bottom_msg'] = '<a class="btn" data-action="close"><span class="btn-text">Cancel</span></a>';

echo json_encode($arr);
