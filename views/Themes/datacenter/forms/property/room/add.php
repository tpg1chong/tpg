<?php

if( !empty($this->item) ){
	$this->building = $this->item['building_id'];
	$this->category = $this->item['category_id'];
	$arr['hiddenInput'][] = array('name'=>'id','value'=> $this->item['id'] );
}
else{

	if( isset($_GET['building']) ){
		$this->building = $_GET['building'];
	}

	if( isset($_GET['category']) ){
		$this->category = $_GET['category'];
	}
}

$form = new Form();
$form = $form->create()->elem('div')->addClass('form-insert form-room');

$form   ->field("property_name")->label( 'Room Name' )->addClass('inputtext')->value( !empty($this->item['name']) ? $this->item['name']: '' );
$form   ->hr( '<div class="ui-hr-text" style="margin-left: -20px;"><span style="background-color:#eeeeee">Room Detail</span></div>' );




if( $this->category == 1 ){


$form   ->field("property_room_total")->label( 'จำนวนห้องพักทั้งหมด' )->type('number')->addClass('inputtext')->value( !empty($this->item['room_total']) ? round($this->item['room_total']): '' );
$form   ->field("property_guests")->label( 'จำนวนผู้เข้าพักที่รับได้' )->type('number')->addClass('inputtext')->value( !empty($this->item['guests']) ? round($this->item['guests']): '' );
$form   ->field("property_price")->label( 'ราคาเริ่มต้น' )->type('number')->addClass('inputtext')->hind('/ ห้อง / คืน')->value( !empty($this->item['price']) ? round($this->item['price']): '' );

$form   ->field("property_group_price")->label( 'ราคาเหมากลุ่ม (Min-Max = ราคา)/ ห้อง / คืน' )->text( '<table data-plugins="groupPrice" class="table-group-price" data-options="'.$this->fn->stringify( array('data'=> !empty($this->item['group_price']) ? $this->item['group_price']: array() ) ).'"><tbody rel="listsbox"></tbody></table>' );

$form   ->field("property_living_area_sqm")->label( 'ขนาดห้องพัก' )->type('number')->addClass('inputtext')->hind('m²')->value( !empty($this->item['living_area_sqm']) ? round($this->item['living_area_sqm']): '' );
$form   ->field("property_living_area_foot")->label('&nbsp;')->type('number')->addClass('inputtext')->hind('ft²')->value( !empty($this->item['living_area_foot']) ? round($this->item['living_area_foot']): '' );

/*$form   ->field("property_size_sqm")->name('property_size[sqm]')->label( 'ขนาดห้องพัก' )->type('number')->addClass('inputtext')->hind('m²')->value( !empty($this->item['living_area_sqm']) ? round($this->item['living_area_sqm']): '' );
$form   ->field("property_size_foot")->name('property_size[foot]')->label('&nbsp;')->type('number')->addClass('inputtext')->hind('ft²')->value( !empty($this->item['living_area_foot']) ? round($this->item['living_area_foot']): '' );*/

}

if( $this->category == 2 ){

	$form   ->field("property_room_total")->name('property_capacity[]')->label( 'ความจุ (ยืน)' )->type('number')->addClass('inputtext')->value( !empty($this->item['capacity'][0]) ? round($this->item['capacity'][0]): '' );
	$form   ->field("property_guests")->name('property_capacity[]')->label( 'ความจุ (นั้ง)' )->type('number')->addClass('inputtext')->value( !empty($this->item['capacity'][1]) ? round($this->item['capacity'][1]): '' );

	$group_price = array();
	$group_price[] = array('label'=>'เต็มวัน', 'id'=>'daily', 'value'=> !empty($this->item['group_price']['daily']) ? $this->item['group_price']['daily'] : '');
	$group_price[] = array('label'=>'ครึ่งวัน', 'id'=>'halfday', 'value'=> !empty($this->item['group_price']['halfday']) ? $this->item['group_price']['halfday'] : '');
	$group_price[] = array('label'=>'ต่อชั่วโมง', 'id'=>'1hour', 'value'=> !empty($this->item['group_price']['1hour']) ? $this->item['group_price']['1hour'] : '');

	$group_price_tr = '';
	foreach ($group_price as $key => $value) {
		$group_price_tr .= '<tr><td style="white-space: nowrap;" class="prs">'.$value['label'].'</td><td><input type="number" name="property_group_price['.$value['id'].']" value="'.$value['value'].'" class="inputtext"></td></tr>';
	}

	$form   ->field("property_group_price")->label( 'ราคา' )->text( '<table><tbody>'. $group_price_tr .'</tbody></table>' );

	$size = array();
	$size[] = array('label'=>'กว้าง', 'id'=>'width', 'value'=> !empty($this->item['size']['width']) ? $this->item['size']['width'] : '');
	$size[] = array('label'=>'ยาว', 'id'=>'length', 'value'=> !empty($this->item['size']['length']) ? $this->item['size']['length'] : '');
	$size[] = array('label'=>'สูง', 'id'=>'height', 'value'=> !empty($this->item['size']['height']) ? $this->item['size']['height'] : '');

	$size_tr = '';
	foreach ($size as $key => $value) {
		$size_tr .= '<tr>'.
			'<td style="white-space: nowrap;" class="prs">'.$value['label'].'</td>'.
			'<td><input type="number" name="property_size['.$value['id'].']" value="'.$value['value'].'" class="inputtext"></td>'.
		'</tr>';
	}

	$form   ->field("property_size")->label( 'ขนาดห้องพัก' )->text( '<table><tbody>'. $size_tr .'</tbody></table>' );

	$form   ->field("property_sunlight")->label( 'แสงแดดเข้าถึง' )->type('checkbox')->items( array(0=>array('id'=>'1', 'name'=>'Yes')) )->value( !empty($this->item['sunlight']) ? round($this->item['sunlight']): '' );
}


$offers = !empty($this->item['offers']) ? $this->item['offers']: array();
$offersList = array();
foreach ($this->offersList as $key => $value) {

	if( empty($offersList[$value['type_id']]) ) $offersList[$value['type_id']] = array('name'=>$value['type_name'], 'items'=>array());
	$offersList[$value['type_id']]['items'][] = $value;

}

$offersListStr = '';
foreach ($offersList as $key => $item) {
	
	$offersListStr .= '<div class="control-label">'.$item['name'].'</div>';

	$offersListStr .='<ul class="uiList list-checkbox">';
	foreach ($item['items'] as $value) {

		$checked = in_array($value['id'], $offers) ? ' checked': '';
		$offersListStr .= '<li style="margin:0;min-width: initial;"><label class="checkbox" style="margin:2px;"><input id="property_offers_18" name="property_offers[]"'.$checked.' type="checkbox" value="'.$value['id'].'"><span>'.$value['name'].'</span></label></li>';
	}
	$offersListStr .= '</ul>';
}

if( $this->category == 1 ){
	$form   ->hr( '<div class="ui-hr-text" style="margin-left: -20px;"><span style="background-color:#eeeeee">สิ่งอำนวยความสะดวกในห้องพัก</span></div>' );
}

$form   ->field("property_offers")->text('checkbox')->text( $offersListStr );


$formRoom = $form->html();

# title
$arr['title'] = 'Create Room';
$arr['hiddenInput'][] = array('name'=>'property_building_id','value'=> !empty($this->building) ? $this->building: '' );
$arr['hiddenInput'][] = array('name'=>'property_category_id','value'=> !empty($this->category) ? $this->category: '' );

$arr['body'] = '<div style="height: 560px;margin: -20px;">'.

	'<table><tr>'.
		'<td style="background: #eee;vertical-align: top;"><div style="height: 560px;overflow-y: scroll;padding: 20px;">'.$formRoom.'</div></td>'.
		'<td style="width: 660px;vertical-align: top;"><div style="height: 560px;overflow-y: scroll;padding: 20px;">'.
			'<div class="uiBoxYellow pam mbm">Recommended size 1280x720 px (.JPG)</div>'.
			'<div class="table-insert-picture-wrap" data-plugins="tableInsertPicture" data-options="'.$this->fn->stringify( array(
				'data'=> !empty($this->item['images']) ? $this->item['images']: array(),
				// 'autoupload' => 1,

			) ).'"></div>'.
		'</div></td>'.

	'</tr></table>'.

'</div>';

# set form
$arr['form'] = '<form class="js-submit-form" method="post" action="'.URL. 'property/save/room/"></form>';

# fotter: button
$arr['button'] = '<button type="submit" class="btn btn-primary btn-submit"><span class="btn-text">'.Translate::val('Save').'</span></button>';
$arr['bottom_msg'] = '<a class="btn" data-action="close"><span class="btn-text">'.Translate::val('Cancel').'</span></a>';

$arr['width'] = 950;

echo json_encode($arr);