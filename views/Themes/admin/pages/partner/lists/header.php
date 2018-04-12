<?php

$filter = '';


/*
$filter .= !empty($filter) ? ' | ':'';
$filter .= '<label class="checkbox"><input type="checkbox" data-action-change="filter" name="slider">ภาพสไลด์ ('.$this->sliderCount.')</label>';

$filter .= !empty($filter) ? ' | ':'';
$filter .= '<label class="checkbox"><input type="checkbox" data-action-change="filter" name="topstory">ข่าวปักหมุด ('.$this->topstoryCount.')</label>';

$filter .= !empty($filter) ? ' | ':'';
$filter .= '<label class="checkbox"><input type="checkbox" data-action-change="filter" name="recommend">หนึ่งมิตรชิดใกล้ ('.$this->recommendCount.')</label>';
*/

$statusActive = !empty($_GET['status']) ? $_GET['status']: 'publish';
$status = '';
/*foreach ($this->statusBar as $key => $value) {

	$status .= !empty($status) ? ' | ':'';
	$active = $statusActive == $value['id'] ? ' class="active"':'';

	$status .= '<a'.$active.' data-action-click="filter" data-name="status" data-value="'.$value['id'].'">'.$value['name'].' ('.$value['count'].')</a>';
} */

/* -- selection -- */
$selection = '';
$dropdown = array();
/*$dropdown[] = array(
    'text' => $this->lang->translate('Listing'),
    // 'href' => '',
    'attr' => array('ajaxify'=>'dialog'),
);*/

$dropdown[] = array(
    'text' => $this->lang->translate('Sticker'),
    'attr' => array('ajaxify'=>URL.'sticker/customers?status=newcomers'),
);

$selection.= '<a class="btn"><i class="icon-pencil mrs"></i>แก้ไข</a>';
$selection.= '<a class="btn btn-blue" ajaxify="'.URL.'organizations/dels"><i class="icon-trash"></i></a>';
/*$selection.= '<a class="btn btn-blue" plugin="dropdown" data-options="'.$this->fn->stringify( array(
        'select' => $dropdown,
        'settings' =>array(
            'axisX'=> 'right',
            // 'parent'=>'.setting-main'
        ) 
    ) ).'"><i class="icon-print"></i><span class="mls">Print</span><i class="mls icon-angle-down"></i></a>';*/

?>
<div ref="header" class="listpage2-header clearfix">

	<div ref="actions" class="listpage2-actions">
		
		<!-- /header top -->
		<div class="clearfix ptm">

			<ul class="lfloat" ref="title">
				<li><h2><i class="icon-<?=$this->pageIcon?> mrs"></i><span><?=$this->lang->translate($this->pageTitle)?></span></h2></li>

				<li class="divider"></li>
			</ul>
			
			<ul class="lfloat" ref="actions">				

				<?php if( $this->pagePermit['add'] ) { ?>
	            <li><div class="rfloat"><a href="<?=$this->pageURL?>add" class="btn btn-blue" data-plugins="lightbox"><i class="icon-plus mrs"></i><?=$this->lang->translate('Add New')?></a></div></li>
	            <!-- <li><div class="rfloat"><a href="<?=URL?>blog/add" data-plugins="lightbox" class="btn btn-blue" ><i class="icon-plus mrs"></i><?=$this->lang->translate('Add New')?></a></div></li> -->
	            <?php } ?>

			</ul>
			
			<ul class="lfloat selection hidden_elem" ref="selection">
				<li class="countVal fwb"><span class="count-value"></span> selected</li>
				<li><span class="group-btn whitespace"><?=$selection?></span></li>
			</ul>

			<ul class="rfloat" ref="control">
				<li><label class="fwb fcg fsm" for="limit"><?=Translate::Val('Items per pages')?></label>
				<select ref="selector" id="limit" name="limit" class="inputtext"><?php
					echo '<option value="20">20</option>';
					echo '<option selected value="50">50</option>';
					echo '<option value="100">100</option>';
					echo '<option value="200">200</option>';
				?></select><span id="more-link"><?=Translate::Val('Loading')?>...</span></li>
			</ul>
		</div>
	
		<!-- <div class="mvm fsm clearfix listpage2-actions-filter">
			<div class="lfloat"><?=$status?></div>
			<div class="rfloat"><?=$filter?></div>
		</div> -->

		<!-- header footer -->
		<div class="clearfix pbm">
			<ul class="lfloat">
				 <!-- data-plugins="tooltip"  -->
				<li><label class="label">&nbsp;</label><a style="vertical-align:top" class="btn js-refresh" title="refresh"><i class="icon-refresh"></i></a></li>	
				
				<?php if( !empty($this->forum) ) { ?>
				<li><label for="forum" class="label">หมวดหมู</label>
				<select ref="selector" name="forum" class="inputtext"><?php
					$option = '';
					$countValTotal = 0;
					foreach ($this->forum as $key => $value) {
						// if( empty($value['count'])  ) continue;

						$selected = '';
						if( !empty($this->pageSettings['company']) ){
							if( $this->pageSettings['company']==$value['id'] ){
								$selected = ' selected';
							}
						}

						$countValTotal += !empty($value['count']) ? $value['count']:0;
						$countVal = !empty($value['count']) ? " ({$value['count']})":'';
						$option .= '<option'.$selected.' value="'.$value['id'].'">'.$value['name'].$countVal.'</option>';
					}
					
					echo '<option value="">ทั้งหมด'. ( $countValTotal>0 ? " ({$countValTotal})":'' ) .'</option>'. $option;

				?></select></li>
				<?php } ?>
				
				<?php if( !empty($this->category) ) { ?>
				<li><label for="cry" class="label">ประเภท</label>
				<select ref="selector" id="cry" name="cry" class="inputtext"><?php
					$option = '';
					$countValTotal = 0;
					foreach ($this->category as $key => $value) {
						// if( empty($value['count'])  ) continue;

						$selected = '';
						if( !empty($this->pageSettings['company']) ){
							if( $this->pageSettings['company']==$value['id'] ){
								$selected = ' selected';
							}
						}

						$countValTotal += !empty($value['count']) ? $value['count']:0;
						$countVal = !empty($value['count']) ? " ({$value['count']})":'';
						$option .= '<option'.$selected.' value="'.$value['id'].'">'.$value['name'].$countVal.'</option>';
					}
					
					echo '<option value="">ทั้งหมด'. ( $countValTotal>0 ? " ({$countValTotal})":'' ) .'</option>'. $option;

				?></select></li>
				<?php } ?>
			</ul>

			<ul class="rfloat">
				<li>
					<label for="category" class="label"><?=Translate::Val('Search')?></label>
					<form class="form-search" action="#">
					<input class="inputtext search-input" type="text" id="search-query" placeholder="<?=Translate::Val('Search')?>..." name="q" autocomplete="off">
					<span class="search-icon"><button type="submit" class="icon-search nav-search" tabindex="-1"></button></span>
				</form></li>
			</ul>
		</div>
		
	</div>

</div>