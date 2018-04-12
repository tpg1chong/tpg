<div style="max-width: 750px;padding: 24px 0;">

	<form class="mbl" data-action-contact="search">
		<table>
			<tbody><tr>
				<td style="width: 100%">
					<h3 class="fwn">Property Rooms</h3>
					<?=!empty($this->roomsList) ? '<div class="fsm" style="margin-top: 2px">'.count( $this->roomsList ).' results</div>': '<span class="fss">Results Not Found</span>'; ?>
				</td>
				<td><a data-plugins="lightbox" href="<?=URL?>property/add/room?building=<?=$this->item['id']?>&category=1" class="btn btn-blue"><i class="icon-plus mrs"></i><span>Create Room</span></a></td>
			</tr>
		</tbody></table>
	</form>

<?php 


$i = 0;
foreach ($this->roomsList as $key => $val) {
	$i++;

?>
<div class="section-table-item">
	<div class="sequence-float"><?=$i?></div>
	<header class="section-table-item-header clearfix">
		
		<div class="title">
			<h3><?=$val['name']?></h3>
		</div>

		<div class="actions">
			<a class="btn-icon" data-plugins="lightbox" href="<?=URL?>property/edit/room/<?=$val['id']?>&category=1"><i class="icon-pencil"></i></a>
			<a class="btn-icon" data-plugins="lightbox" href="<?=URL?>property/del/room/<?=$val['id']?>"><i class="icon-trash-o"></i></a>
		</div>
	</header>


	<div class="section-table-item-desc">
		<table class="section-table-item-table"><tbody>
			
			<tr>
				<td style="width:300px;padding: 10px;">
					<div class="pic" style="display: block;height: 0;width: 100%;overflow: hidden;position: relative;padding-top: 56.25%;background-color: #f0f0f0;"><?php 

					if( !empty($val['images'][0]) ){
						echo '<img style="position: absolute;top: 0;left: 0;right: 0;bottom: 0;max-width: 100%;" src="'.$val['images'][0]['src'].'">';
					}

					?></div>
				</td>

				<td>

					<table class="table-data-info">
						<tr>
							<td class="td-label">Status:</td>
							<td colspan="2">
								<span class="ui-status">Available</span>
							</td>
						</tr>
						<tr>
							<td class="td-label">ห้องพักทั้งหมด:</td>
							<td class="td-data"><p><?= !empty($val['room_total']) ? $val['room_total']: '-' ?></p></td>
							<td class="text-hind">ห้อง</td>
						</tr>
						<tr>
							<td class="td-label">ผู้เข้าพักที่รับได้:</td>
							<td class="td-data"><?= !empty($val['guests']) ? $val['guests']: '-' ?></td>
							<td class="text-hind">ท่าน/ห้อง</td>
						</tr>
						<tr>
							<td class="td-label">ขนาดห้องพัก:</td>
							<td class="td-data" colspan="2">
								
								<span><?= $val['living_area_sqm']>0 ? round($val['living_area_sqm']): '-' ?></span> <span class="text-hind">m²</span> / <span><?= $val['living_area_foot']>0 ? round($val['living_area_foot']): '-' ?></span> <span class="text-hind">ft²</span>
							</td>
						</tr>
						<tr>
							<td class="td-label">ราคา:</td>
							<td class="td-data"><strong class="fwxl fcr"><?= !empty($val['price']) ? number_format($val['price']): '-' ?></strong></td>
							<td class="text-hind">/ห้อง/คืน</td>
						</tr>

						<tr>
							<td class="td-label" colspan="3">
								<?php

								if( !empty($val['group_price']) ){
									echo '<label>ราคาเหมารวมกลุ่ม:</label>';
									echo '<table class="table-groupprice"><tbody>';
									foreach ($val['group_price'] as $key => $value) {
										
										echo '<tr>';
											echo '<td class="td-min">'.$value['min'].'</td>';
											echo '<td class="td-debar">-</td>';
											echo '<td class="td-max">'.$value['max'].'</td>';
											echo '<td class="td-debar">=</td>';
											echo '<td class="td-price">'. number_format($value['price']).'</td>';
											echo '<td class="td-actions">/ห้อง/คืน</td>';
										echo '</tr>';
									}
									echo '</tbody></table>';
								}

							?>
							</td>
						</tr>
					</table>
					
				</td>
				<td style="width: 190px">
					<label>อัพเดทข้อมูลล่าสุด:</label>

					<div>
						<?php
						if( !empty($val['updated']) ){

							echo '<p>'. $this->fn->q('time')->live($val['updated']).'</p>';

							if( !empty($val['user_update_username']) ){
								echo '<div style="font-size: 11px;">By '.$val['user_update_username'].'</div>';
							}
						}
						else{
							echo '<p>-</p>';
						}
						
						?>
					</div>
				</td>
			</tr>

			
			<tr>
				<td colspan="3">
					<!-- <label>สิ่งอำนวยความสะดวกในห้องพัก:</label> -->
					<?php 

					$val['offers'] = !empty($val['offers']) ? $val['offers']: array();

					$offersList = array();
					foreach ($this->offersList as $key => $value) {

						if( empty($offersList[$value['type_id']]) ) $offersList[$value['type_id']] = array('name'=>$value['type_name'], 'items'=>array());
						$offersList[$value['type_id']]['items'][] = $value;

					}

					
					foreach ($offersList as $key => $item) {
						echo '<div class="mvm">';
						echo '<div><label>'.$item['name'].'</label></div>';

						echo '<ul class="uiList list-checkbox">';
						foreach ($item['items'] as $value) {

							$icon = in_array($value['id'], $val['offers']) ? 'check': 'remove';
							echo '<li style="color:'.($icon=='check' ? '#673AB7': '#F44336').'"><i class="icon-'.$icon.'"></i><span class="mls">'.$value['name'].'</span></li>';
						}
						echo '</ul>';
						echo '</div>';
					}

					


					?>

				</td>
				
			</tr>
		</tbody></table>
	</div>
</div>

<?php } ?>

</div>