<?php

$this->position = array();
$position = '';
foreach ($this->position as $key => $value) {
	$position .= '<option value="'.$value['id'].'">'.$value['name'].'</option>';
}

$form = new Form();
$form = $form->create()->elem('div')->addClass('form-insert');
$form 	->field("invite")
		->text( ''.

	'<div class="ui-invite-content">'.

	'<div class="ui-invite-header" ref="header">'.

		'<div ref="actions">'.

			/*'<header class="ui-invite-listsbox-header clearfix">'.
				'<div class="lfloat ui-invite-actions">'.
					'<label style="display: inline-block;">ระดับ</label> <select class="inputtext" act="selector" name="position" style="display: inline-block;width:auto">'.
						// '<option>ทั้งหมด</option>'.
						'<option value="queue">vip</option>'.
						// '<option value="all">พนักงานทั้งหมด</option>'.
						
					'</select>'.
				'</div>'.
				// '<div class="rfloat"><a class="js-selected-all">เลือกทั้งหมด</a></div>'.
			'</header>'.*/

			'<div class="form-search"><input type="text" name="q" class="inputtext input-search" act="inputsearch" autofocus placeholder="Search..."><button type="button" class="btn-search"><i class="icon-search"></i></button></div>'.	

		'</div>'.
	'</div>'.

	'<div class="ui-invite-listsbox has-loading">'.
		'<ul class="ui-list ui-list-user ui-list-checked" ref="listsbox"></ul>'.
		'<a class="ui-more btn">โหลดเพิ่มเติม</a>'.
		'<div class="ui-alert">'.
			'<div class="ui-alert-loader">
				<div class="ui-alert-loader-icon loader-spin-wrap"><div class="loader-spin"></div></div>
				<div class="ui-alert-loader-text">กำลังโหลด...</div> 
			</div>

			<div class="ui-alert-error">
				<div class="ui-alert-error-icon"><i class="icon-exclamation-triangle"></i></div>
				<div class="ui-alert-error-text">ไม่สามารถเชื่อมต่อได้</div> 
			</div>

			<div class="ui-alert-empty">
				<div class="ui-alert-empty-text">no result</div> 
			</div>'.
		'</div>'.
	'</div>'.	

	'</div>'.
	// end: ui-invite-content

	'<div class="ui-invite-selected">'.
		'<header class="ui-invite-selected-header clearfix">'.
			'<div class="lfloat">เลือกแล้ว (<span class="js-selectedCountVal">0</span>)</div>'.
		'</header>'.
		'<div class="ui-invite-selected-listsbox">'.
			'<ul class="ui-list ui-list-token ui-list-horizontal" ref="tokenbox"></ul>'.
		'</div>'.
	'</div>'.

'');

$formInvite = $form->html();

$optionsInvite = array(
	'url' => URL.'partner/invite',
);

if( !empty($this->item['partner_id']) ){
	$invite['partner'][] = array('type'=>'partner', 'id'=> $this->item['partner_id']);
	$optionsInvite['invite'] = $invite;
}

# body
$arr['body'] = '<div class="ui-invite-wrap" data-plugins="invite" data-options="'.$this->fn->stringify($optionsInvite).'">'.
	'<div class="ui-invite">'.$formInvite.'</div>'.
'</div>';

$arr['width'] = 550;

# set form
$arr['form'] = '<form class="js-submit-form" method="post" action="'.URL. 'place/invite_partner"></form>';
$arr['hiddenInput'][] = array('name'=>'id','value'=>$this->item['id']);

$arr['title']= "Partner";


$arr['button'] = '<button type="submit" class="btn btn-primary btn-submit"><span class="btn-text">'.Translate::val('Save').'</span></button>';
$arr['bottom_msg'] = '<a class="btn" data-action="close"><span class="btn-text">'.Translate::val('Cancel').'</span></a>';
echo json_encode($arr);