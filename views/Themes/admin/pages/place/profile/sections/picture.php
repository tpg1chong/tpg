<?php

echo '<div class="mvl" style="width: 760px;">'.
	'<div class="uiBoxYellow pam mbm">Recommended size 1280x720 px (.JPG)</div>'.
	'<div class="table-insert-picture-wrap" data-plugins="tableInsertPicture" data-options="'.$this->fn->stringify( array(
		'data'=> !empty($this->item['images']) ? $this->item['images']: array(),
		'autoupload' => 1,

	) ).'"></div>'.
'</div>';