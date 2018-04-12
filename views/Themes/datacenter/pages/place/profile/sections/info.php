<?php

$form = new Form();
$form = $form->create()->elem('div')->style('horizontal')->addClass('form-insert');
/*->style('horizontal')*/

$form   ->field("type_id")
        ->type( 'select' )
        ->label( 'Property Type' )
        ->addClass('inputtext')
        ->select( $this->typeList )
        ->value( !empty($this->item['type_id']) ? $this->item['type_id']: '' );

$form   ->field("name")
        ->label( 'Name' )
        ->addClass('inputtext')
        ->autocomplete('off')
        ->placeholder('Add name')
        ->value( !empty($this->item['name']) ? $this->item['name']: '' );

$form   ->field("description")
        ->type( 'textarea' )
        ->label( Translate::Val('Description') )
        ->addClass('inputtext')
        ->placeholder('Add description')
        ->attr('data-plugins', 'autosize')
        ->value( !empty($this->item['description']) ? $this->item['description']: '' );

$form   ->field("built")
        ->label( 'Built' )
        ->addClass('inputtext')
        ->placeholder('Add built')
        ->value( !empty($this->item['built']) ? $this->item['built']: '' );

$form   ->hr('<div class="ui-hr-text"><span>Locations</span></div>');

$form   ->field("location_country")
        ->name( 'location[country]' )
        ->label( 'ประเทศ' )
        ->autocomplete('off')
        ->addClass('inputtext')
        ->select( $this->countryList, 'id', 'name', false )
        ->value( !empty($this->item['location_country']) ? $this->item['location_country']: '' );

$form   ->field("location_province")
        ->name( 'location[province]' )
        ->label('จังหวัด')
        ->autocomplete('off')
        ->addClass('inputtext')
        ->select( array() )
        ->value( !empty($this->item['location_province']) ? $this->item['location_province']: '' );

$form   ->field("location_zone")
        ->name( 'location[zone]' )
        ->label('อำเภอ/เขต')
        ->autocomplete('off')
        ->addClass('inputtext')
        ->select( array() )
        ->value( !empty($this->item['location_zone']) ? $this->item['location_zone']: '' );

$form   ->field("location_district")
        ->name( 'location[district]' )
        ->label('ตำบล/แขวง')
        ->autocomplete('off')
        ->addClass('inputtext')
        ->select( array() )
        ->value( !empty($this->item['location_district']) ? $this->item['location_district']: '' );

$form   ->field("location_road")
        ->name( 'location[road]' )
        ->label('ถนน')
        ->autocomplete('off')
        ->addClass('inputtext')
        ->value( !empty($this->item['location_road']) ? $this->item['location_road']: '' );

$form   ->field("location_soi")
        ->name( 'location[soi]' )
        ->label('ซอย')
        ->autocomplete('off')
        ->addClass('inputtext')
        ->value( !empty($this->item['location_soi']) ? $this->item['location_soi']: '' );


$form   ->field("location_number")
        ->name( 'location[number]' )
        ->label('บ้านเลขที่')
        ->autocomplete('off')
        ->addClass('inputtext')
        ->value( !empty($this->item['location_number']) ? $this->item['location_number']: '' );



/*$form   ->field("email")
        ->label( Translate::Val('Email') )
        ->text( $this->fn->q('form')->contacts('email') );*/
/*$form   ->field("phone")
        ->label( Translate::Val('Phone') )
        ->text( $this->fn->q('form')->contacts('phone') );*/
        

/*$form   ->hr('<div class="ui-hr-text"><span>Contacts</span></div>');
$form   ->field("email")
        ->label( Translate::Val('Email') )
        ->addClass('inputtext')
        ->autocomplete('off')
        ->placeholder('Add email');


$form   ->field("phone")
        ->label( Translate::Val('Phone') )
        ->addClass('inputtext')
        ->autocomplete('off')
        ->placeholder('Add phone');

$form   ->field("fax")
        ->label( Translate::Val('Fax') )
        ->addClass('inputtext')
        ->autocomplete('off')
        ->placeholder('Add fax');

$form   ->field("social")
        ->label( Translate::Val('Social') )
        ->text( $this->fn->q('form')->contacts('social') );

$form   ->field("website")
        ->label( Translate::Val('Website') )
        ->addClass('inputtext')
        ->placeholder('Add website');*/

/*
$form   ->hr('<div class="ui-hr-text"><span>Facilities</span></div>');
$form   ->field("facilities")
        ->label( 'Facilities' )
        ->type( 'checkbox' )
        ->items( $this->facilitiesList );*/

$formLeft = $form->html();

$form = new Form();
$form = $form->create()->elem('div')->addClass('form-insert');


$form   ->field("enabled")
        ->label( 'Display' )
        
        ->type( 'checkbox' )
        ->items( array( 0=> array('id'=>'1', 'name'=>'Enabled', 'checked' => !empty($this->item['enabled'])) ) );


// $form   ->hr('<div class="ui-hr-text"><span>Note</span></div>');

$form   ->field("note")
        ->type( 'textarea' )
        ->label( 'Note' )
        ->addClass('inputtext')
        ->placeholder('Add note')
        ->value( !empty($this->item['note']) ? $this->item['note']: '' );

# body
echo '<div style="position:relative;">'.
    '<div class="pal" style="width:600px;vertical-align:top;">'. $formLeft.'</div>'.
    '<div class="pal" style="position:absolute;border-left:1px solid #eee;left:600px;top:0;bottom:0;right:0;overflow-y:auto"><div style="width:240px;">'.$form->html().'</div></div>'.
'</div>';