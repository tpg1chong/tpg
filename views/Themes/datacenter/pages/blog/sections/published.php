<?php

$url = URL.'property/';


?><div data-load="<?=URL?>property/placesList?has_item=1" class="SettingCol offline">

<div class="SettingCol-header"><div class="SettingCol-contentInner">
	<div class="clearfix">
		<ul class="clearfix lfloat SettingCol-headerActions">

			<li><h2><i class="icon-newspaper-o mrs"></i><span><?= Translate::Val('Published Posts') ?></span></h2></li>

		</ul>
		<ul class="rfloat SettingCol-headerActions clearfix">
			<li><a class="btn btn-blue" data-plugins="dialog" href="<?=$url?>add/places/"><i class="icon-plus mrs"></i><span><?=$this->lang->translate('Add New')?></span></a></li>
			
		</ul>
		
	</div>

	<div class="mtm clearfix form-actions">
		<ul class="lfloat SettingCol-headerActions clearfix">
			<li>
				<form class="form-search" action="#">
				<input class="search-input inputtext" type="text" id="search-query" placeholder="<?= Translate::Val('Search') ?>" name="q" autocomplete="off"><span class="search-icon"><button type="submit" class="icon-search nav-search" tabindex="-1"></button></span>
			</form></li>
		</ul>
		<ul class="rfloat SettingCol-headerActions clearfix">
			
			
			<li id="more-link"></li>
		</ul>
	</div>
	<!-- <div class="setting-description mtm uiBoxYellow pam">Manage your personal employee settings.</div> -->
</div></div>

<div class="SettingCol-main">
	<div class="SettingCol-tableHeader"><div class="SettingCol-contentInner">
		<table class="settings-table admin"><thead><tr>
			<th class="name" data-col="0">Name</th>
			<th class="email" data-col="1"></th>
			<th class="actions" data-col="2">Action</th>
		</tr></thead></table>
	</div></div>
	<div class="SettingCol-contentInner">
	<div class="SettingCol-tableBody"></div>
	<div class="SettingCol-tableEmpty empty">
		<div class="empty-loader">
			<div class="empty-loader-icon loader-spin-wrap"><div class="loader-spin"></div></div>
			<div class="empty-loader-text">Loading...</div>
		</div>
		<div class="empty-error">
			<div class="empty-icon"><i class="icon-link"></i></div>
			<div class="empty-title">Connection Error.</div>
		</div>

		<div class="empty-text">
			<div class="empty-icon"><i class="icon-users"></i></div>
			<div class="empty-title">No Results Found.</div>
		</div>
	</div>
	</div>
</div>

</div>