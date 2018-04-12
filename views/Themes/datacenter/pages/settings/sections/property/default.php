<div class="pal mhl mvm">
	<div class="setting-header cleafix">
		<div class="setting-title">Customize Property</div>
	</div>

	<?php if( !empty($this->sub['property']) ){ ?>

	<div class="setting-hr"></div>
	
	<ul><?php
	
	foreach ($this->sub['property'] as $key => $value) { ?>

		<li class="SettingsContent_overviewSection">
	      <div class="SettingsContent_overviewTitle">
	        <a href="<?=$value['url']?>"><?=$value['text']?></a>
	      </div>
	      <?php if( !empty($value['description']) ) { ?>
	      <div class="SettingsContent_description"><?=$value['description']?></div>
	      <?php } ?> 
	      
	    </li>
	<?php } ?></ul>

	<?php } ?>
</div>

