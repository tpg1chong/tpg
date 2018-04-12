<?php



$form = new Form();
$form = $form->create()
	->elem('div')
	->addClass('form-insert');

/*$form   ->field("user_role_id")
        ->label( 'บทบาท*')
        ->autocomplete('off')
        ->addClass('inputtext')
        ->select( $this->roles );*/

$form   ->field("user_name")
        ->label( 'Name' )
        ->autocomplete('off')
        ->addClass('inputtext')
        ->placeholder('')
        ->attr('autofocus', '1')
        ->value( isset($_GET['name']) ? $_GET['name']: '' );

$form   ->field("user_login")
        ->label('Username')
        ->autocomplete('off')
        ->addClass('inputtext');


$form   ->field('auto_password')
        ->text('<div class="fsm"><label class="checkbox" for="auto_password"><input type="checkbox" id="auto_password" name="auto_password" checked><span class="mls">กำหนดรหัสผ่านอัตโนมัติ</span></label></div>');

$form   ->field("password")
        ->label('Password')
        ->type('password')
        ->maxlength(30)
        ->autocomplete('off')
        ->addClass('inputtext');


# set form
$arr['form'] = '<form class="js-submit-form" method="post" action="'.URL. '__test/save"></form>';

# body
$arr['body'] = $form->html().'<a class="btn" href="'.URL.'__test/lightbox" data-plugins="lightbox">dialog</a>';

# title
$arr['title']= 'สร้างผู้ใช้ใหม่';


# fotter: button
$arr['button'] = '<button type="submit" class="btn btn-primary btn-submit"><span class="btn-text">'.$this->lang->translate('Save').'</span></button>';
$arr['bottom_msg'] = '<a class="btn" data-action="close"><span class="btn-text">Cancel</span></a>';


echo json_encode($arr);