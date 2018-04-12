<?php

$form = new Form();
$form = $form->create()
	// set From
	->elem('div')
	->addClass('form-insert');

$form   ->field("partner_name")
        ->label($this->lang->translate('Name').'*')
        ->autocomplete('off')
        ->addClass('inputtext')
        ->placeholder('')
        ->value( !empty($this->item['name'])? $this->item['name']:'' );

$form   ->field("partner_username")
        ->label($this->lang->translate('Username').'*')
        ->autocomplete('off')
        ->addClass('inputtext')
        ->value( !empty($this->item['username'])? $this->item['username']:'' );

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
$arr['hiddenInput'][] = array('name'=>'id', 'value'=> $this->item['id']);
$arr['form'] = '<form class="js-submit-form" method="post" action="'.URL. 'partner/edit"></form>';

# body
$arr['body'] = $form->html();

# title
$arr['title']= 'เปลี่ยนชื่อผู้ใช้';

# fotter: button
$arr['button'] = '<button type="submit" class="btn btn-primary btn-submit"><span class="btn-text">'.Translate::val('Save').'</span></button>';
$arr['bottom_msg'] = '<a class="btn" data-action="close"><span class="btn-text">'.Translate::val('Cancel').'</span></a>';


echo json_encode($arr);