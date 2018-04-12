<div style="max-width: 750px;padding: 24px 0;">

	<form class="mbl" data-action-contact="search">
		<table>
			<tbody><tr>
				<td style="width: 100%">
					<h3 class="fwn">Property Rooms</h3>
					<?=!empty($this->roomsList) ? '<div class="fsm" style="margin-top: 2px">'.count( $this->roomsList ).' results</div>': '<span class="fss">Results Not Found</span>'; ?>
				</td>
				<td><a data-plugins="lightbox" href="<?=URL?>property/add/room?building=<?=$this->item['id']?>&category=2" class="btn btn-blue"><i class="icon-plus mrs"></i><span>Create Room</span></a></td>
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
			<a class="btn-icon" data-plugins="lightbox" href="<?=URL?>property/edit/room/<?=$val['id']?>&category=2"><i class="icon-pencil"></i></a>
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
							<td class="td-label">ความจุ (ยืน):</td>
							<td class="td-data"><p><?= !empty($val['capacity'][0]) ? number_format($val['capacity'][0]): '-' ?></p></td>
							<td class="text-hind">คน</td>
						</tr>
						<tr>
							<td class="td-label">ความจุ (นั้ง):</td>
							<td class="td-data"><?= !empty($val['capacity'][1]) ? number_format($val['capacity'][1]): '-' ?></td>
							<td class="text-hind">คน</td>
						</tr>
						

						<tr>
							<td class="td-label" colspan="3">
								<?php

								if( !empty($val['group_price']) ){
									echo '<label>ราคา:</label>';
									echo '<table class="table-groupprice"><tbody>';

									$a = array( 'daily'=>'เต็มวัน', 'halfday'=>'ครึ่งวัน', '1hour'=>'ต่อชั่วโมง' );
									foreach ($val['group_price'] as $key => $value) {
										
										echo '<tr>';
											echo '<td style="text-align: right;">'.$a[$key].'</td>';
											echo '<td class="td-debar">=</td>';
											echo '<td style="text-align: right;width: 40px;white-space: nowrap;" class="td-price"><strong class="fwxl fcr">'. (!empty($value) ? number_format($value) : '-').'</strong></td>';
										echo '</tr>';
									}
									echo '</tbody></table>';
								}

							?>
							</td>
						</tr>

						<tr>
							<td class="td-data" colspan="3">
								<?php 

								$txt = '';
								$title = '';

								$a = array( 'width'=>'กว้าง', 'length'=>'ยาว', 'height'=>'สูง' );
								foreach ($val['size'] as $key => $value) {
									
									$txt .= !empty($txt) ? ', ':'';
									$txt .= '<span>'. $a[$key]. ' '. (!empty($value)? $value: '-').'</span> <span class="text-hind">ม.</span>';
									// $txt .= ''.(!empty($value)? $value: '-').'</span>';
								}
								echo '<span title="'.$title.'">'.$txt.'</span>';
								?>
							</td>
						</tr>

						<tr>
							<td class="td-label">แสงแดดเข้าถึง:</td>
							<td class="td-data"><?= !empty($value['sunlight']) ? '<i class="icon-check"></i>':'<i class="icon-remove"></i>' ?></td>
							<td class="text-hind"></td>
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

					echo '<div class="mtm">';
					foreach ($offersList as $key => $item) {
						
						echo '<div><label>'.$item['name'].'</label></div>';

						echo '<ul class="uiList list-checkbox">';
						foreach ($item['items'] as $value) {

							$icon = in_array($value['id'], $val['offers']) ? 'check': 'remove';
							echo '<li style="color:'.($icon=='check' ? '#673AB7': '#F44336').'"><i class="icon-'.$icon.'"></i><span class="mls">'.$value['name'].'</span></li>';
						}
						echo '</ul>';

					}

					echo '</div>';


					?>

				</td>
				
			</tr>
		</tbody></table>
	</div>
</div>

<?php } ?>

</div>