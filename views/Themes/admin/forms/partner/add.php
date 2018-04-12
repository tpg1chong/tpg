<?php

$form = new Form();
$form = $form->create()
	// set From
	->elem('div')
	->addClass('form-insert');

$form   ->field("partner_name")
        ->label(Translate::Val('Name').'*')
        ->autocomplete('off')
        ->addClass('inputtext')
        ->placeholder('')
        ->attr('autofocus', '1');

$form   ->field("partner_username")
        ->label(Translate::Val('Username').'*')
        ->autocomplete('off')
        ->addClass('inputtext');

$form   ->field('auto_password')
        ->text('<div class="fsm"><label class="checkbox" for="auto_password"><input type="checkbox" id="auto_password" name="auto_password" checked><span>กำหนดรหัสผ่านอัตโนมัติ</span></label></div>');

$form   ->field("password")
        ->label(Translate::Val('Password').'*')
        ->type('password')
        ->maxlength(30)
        ->autocomplete('off')
        ->addClass('inputtext');

$form   ->field("partner_email")
        ->label( 'Email' )
        ->autocomplete('off')
        ->addClass('inputtext')
        ->value( !empty($this->item['email'])? $this->item['email']:'' );

$form   ->field("partner_phone")
        ->label($this->lang->translate('Phone'))
        ->autocomplete('off')
        ->addClass('inputtext')
        ->value( !empty($this->item['phone'])? $this->item['phone']:'' );


# set form
$arr['form'] = '<form class="form-emp-add" method="post" action="'.URL. 'partner/save"></form>';

# body
$arr['body'] = $form->html();

# title
$arr['title']= 'Create partner';


# fotter: button
$arr['button'] = '<button type="submit" class="btn btn-primary btn-submit"><span class="btn-text">'.Translate::val('Save').'</span></button>';
$arr['bottom_msg'] = '<a class="btn" data-action="close"><span class="btn-text">'.Translate::val('Cancel').'</span></a>';


echo json_encode($arr);