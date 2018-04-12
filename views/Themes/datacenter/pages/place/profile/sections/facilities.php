<?php 

$lists = array();
foreach ($this->facilitiesList as $key => $value) {

	if( empty($lists[$value['type_id']]) ) $lists[$value['type_id']] = array('name'=>$value['type_name'], 'items'=>array());

	$lists[$value['type_id']]['items'][] = $value;
}

echo '<div class="mal" style="max-width:750px"><table><tbody>';
foreach ($lists as $key => $val) {
	
	echo '<tr>';
		echo '<td style="vertical-align: top;width: 150px;" class="pbl prl"><strong>'.$val['name'].'</strong></td>';

		echo '<td style="vertical-align: top;"class="pbl"><ul class="uiList list-checkbox">';
		foreach ($val['items'] as $value) {
			echo '<li style="min-width: 200px;margin: 0;
    padding: 0;margin-right:4px"><label class="checkbox" style="margin:2px;"><input name="property_offers[]" type="checkbox" value="'.$value['id'].'"><span>'.$value['name'].'</span></label></li>';
		}
		echo '</ul></td>';

	echo '</tr>';
}

echo '</tbody></table></div>';