<?php

# title
$title = 'City';

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

$form 	->field("city_code")
      	->label( 'Code*' )
          ->autocomplete('off')
          ->addClass('inputtext')
          ->placeholder('')
          ->value( !empty($this->item['code'])? $this->item['code']:'' );


$form 	->field("city_name")
    	->label( 'Name*' )
        ->autocomplete('off')
        ->addClass('inputtext')
        ->placeholder('')
        ->attr('autofocus', 1)
        ->value( !empty($this->item['name'])? $this->item['name']:'' );

# set form
$arr['form'] = '<form class="js-submit-form" method="post" action="'.URL. 'location/save/city/"></form>';

# body
$arr['body'] = $form->html();

# fotter: button
$arr['button'] = '<button type="submit" class="btn btn-primary btn-submit"><span class="btn-text">Save</span></button>';
$arr['bottom_msg'] = '<a class="btn" data-action="close"><span class="btn-text">Cancel</span></a>';

echo json_encode($arr);
