<form data-plugins="formPlacesCreate" class="form-places-create uiBoxWhite" action="<?=URL?>location/save/places" method="post">

	<div class="form-places-create-header cleafix">
		<div class="form-places-create-title"><i class="icon-plus mrs"></i>Create Places</div>
	</div>
	<?php
	$fristStep = 'location';

	$step = array();
	$step[] = array('text'=>'Location', 'name'=>'location');
	$step[] = array('text'=>'Basic Info', 'name'=>'basic');
	$step[] = array('text'=>'Details', 'name'=>'detail');
	$step[] = array('text'=>'Picture', 'name'=>'picture');
	

	echo '<div class="form-places-create-step clearfix" data-ref="step">';
		echo $this->fn->stepList($step, $fristStep);
	echo '</div>';

	?>	

	<input id="options_type" type="hidden" name="options[type]" value="<?=$fristStep?>">
	<input id="options_save" type="hidden" name="options[save]" value="">
	<div class="form-places">
		<?php

		foreach ($step as $key => $value) {

			$path = __DIR__. "/create/{$value['name']}.php";
			if( file_exists($path) ){

				$active = $fristStep==$value['name'] ? ' active':'';
				echo '<div class="form-places-section clearfix'.$active.'" data-section="'.$value['name'].'">';
				require_once "create/{$value['name']}.php";
				echo '</div>';
			}
		}

		?>
	</div>

	<div class="form-places-create-footer uiBorderTop clearfix">
		<div class="lfloat">
			<button data-action="prev" type="button" class="btn">Back</button>
		</div>
		<div class="rfloat">
			<button data-action="submit" type="submit" class="btn btn-blue btn-submit"><span class="text-submit-next">Next</span><span class="text-submit-save">Save</span></button>
		</div>
	</div>

</div>