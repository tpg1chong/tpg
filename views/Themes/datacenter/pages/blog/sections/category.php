<?php


$this->direction = URL.'blog/';

?><div class="setting-header clearfix">
	<div class="rfloat">
		<a class="btn btn-blue" data-plugins="lightbox" href="<?=$this->direction?>add/category/"><i class="icon-plus mrs"></i><span><?=Translate::Val('Add New')?></span></a>
	</div>
	<div class="lfloat">
		<div class="setting-title" style="line-height: 30px"><i class="icon-code-fork mrs"></i><?=Translate::Val('Blog Category')?>
		</div>
	</div>

	<select class="inputtext" data-action="filter">
		<option value="">ทั้งหมด</option>
		<?php 
	foreach ($this->forum as $val) {

			$selected = '';
			if( !empty($_GET['forum']) ){
				$selected = $_GET['forum']==$val['id'] ? ' selected':'';
			}
			
			echo '<option'.$selected.' value="'.$val['id'].'">'.$val['name'].'</option>';
		}
	?></select>

</div>


<section class="setting-section">
	<table class="settings-table admin"><tbody>
		<tr>
			<th class="name"><?=Translate::Val('Name')?></th>
			
			<th class="status">เปิดใช้งาน</th>
			<th class="status">กลุ่มข่าว</th>
			<th class="actions"></th>

		</tr>

		<?php foreach ($this->dataList as $key => $item) { ?>
		<tr data-id="<?=$item['id']?>">
			<td class="name fwb"><?php

				echo '<a href="'.$this->direction.'edit/category/'.$item['id'].'" data-plugins="lightbox">'.$item['name'].'</a>';


			?></td>
		
			
			
			<td class="status">
				<label class="checkbox"><input data-action="change" type="checkbox" name="cry_enabled"<?=( !empty($item['enabled'])? ' checked':'' )?>></label>
			</td>

			<td class="status">
				<select class="inputtext" data-action="change" name="cry_forum_id"><?php 

					echo '<option  value="-"></option>';
				foreach ($this->forum as $val) {

					$disabled = !empty($val['enabled']) ? '':' disabled';
					$selected = $val['id']==$item['forum_id'] ? ' selected':'';

					echo '<option'.$disabled.$selected.' value="'.$val['id'].'">'.$val['name'].'</option>';
				}

				?></select>
			</td>

			<td class="actions whitespace">
				<?php

				$dropdown = array();

				$dropdown[] = array(
	                'text' => Translate::Val('Edit'),
	                'href' => $this->direction.'edit/category/'.$item['id'],
	                'attr' => array('data-plugins'=>'lightbox'),
	                // 'icon' => 'pencil'
	            );

				$dropdown[] = array(
	                'text' => Translate::Val('Delete'),
	                'href' => $this->direction.'del/category/'.$item['id'],
	                'attr' => array('data-plugins'=>'lightbox'),
	                // 'icon' => 'remove'
	            );

	            if( !empty($dropdown) ){

				echo '<a data-plugins="dropdown" class="btn btn-no-padding" data-options="'.$this->fn->stringify( array(
                        'select' => $dropdown,
                        'settings' =>array(
                            'axisX'=> 'right',
                            'parentElem'=>'.setting-main'
                        ) 
                    ) ).'"><i class="icon-ellipsis-v"></i></a>';

				}

				?>
					
			</td>

		</tr>
		<?php } ?>
	</tbody></table>
</section>