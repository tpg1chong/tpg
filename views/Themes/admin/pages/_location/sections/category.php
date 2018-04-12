<?php


$this->direction = URL.'property/';
$this->modelName = 'category';

?><div class="setting-header cleafix">

	<div class="rfloat">

		<a class="btn btn-blue" data-plugins="lightbox" href="<?=$this->direction?>add/<?=$this->modelName?>/"><i class="icon-plus mrs"></i><span><?=Translate::Val('Add New')?></span></a>

	</div>

	<div class="setting-title"><i class="icon-code-fork mrs"></i>Place Category</div>
</div>

<section class="setting-section">
	<table class="settings-table admin"><tbody>
		<tr>
			<th class="name">Category name</th>
			<th class="status">เปิดใช้งาน</th>
			<th class="actions"></th>

		</tr>

		<?php foreach ($this->dataList as $key => $item) { ?>
		<tr data-id="<?=$item['id']?>">
			<td class="name fwb"><?php

				echo '<a href="'.$this->direction."edit/{$this->modelName}/{$item['id']}".'" data-plugins="lightbox">'.$item['name'].'</a>';
			?></td>


			<td class="status">
				<label class="checkbox"><input data-action="change" type="checkbox" name="forum_enabled"<?=( !empty($item['enabled'])? ' checked':'' )?>></label>
			</td>

			<td class="actions whitespace">
				<?php

				$dropdown = array();

				$dropdown[] = array(
	                'text' => Translate::Val('Edit'),
	                'href' => $this->direction."edit/{$this->modelName}/{$item['id']}",
	                'attr' => array('data-plugins'=>'lightbox'),
	                // 'icon' => 'pencil'
	            );

				$dropdown[] = array(
	                'text' => Translate::Val('Delete'),
	                'href' => $this->direction."del/{$this->modelName}/{$item['id']}",
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
