<?php

?><div data-load="<?=URL?>location/districtList?has_item=1" stop class="SettingCol offline">

	<div class="SettingCol-header"><div class="SettingCol-contentInner">
		<div class="clearfix">
			<ul class="clearfix lfloat SettingCol-headerActions">
				<li><h2><span><?= Translate::Val('District') ?></span></h2></li>
				<li class="divider"></li>
				<li><a data-action="refresh" class="btn"><i class="icon-refresh"></i></a></li>
				
			</ul>
			<ul class="rfloat SettingCol-headerActions clearfix">
				<li><a class="btn btn-blue" href="<?=URL?>admin/location/create"><i class="icon-plus mrs"></i><span><?=$this->lang->translate('Add New')?></span></a></li>
			</ul>

		
		</div>

		<div class="mtm clearfix">
			<ul class="lfloat SettingCol-headerActions clearfix">
				
				<li><label class="label" for="country">Country:</label><select id="country" class="inputtext" name="country" ref="selector" style="width: 120px" stop><?php foreach ($this->countryList as $key => $value) {
					echo '<option value="'.$value['id'].'">'.$value['name'].'</option>';
				} ?></select></li>

				<li><label class="label" for="country">Province:</label><select id="province" class="inputtext" name="province" style="width: 150px" ref="selector" stop></select></li>

				<li><label class="label" for="zone">Zone:</label><select id="zone" class="inputtext" name="zone" style="width: 150px" ref="selector"></select></li>
			</ul>
			<ul class="rfloat SettingCol-headerActions clearfix">
				<li><label class="checkbox" style="margin-top: 18px;font-size: 12px;"><input type="checkbox" name="enabled" data-action="checkbox" checked><span>Enabled Only</span></label></li>
				<li>
					<label class="label" for="search-query"><?= Translate::Val('Search') ?>:</label>
					<form class="form-search" action="#">
					<input class="search-input inputtext" type="text" id="search-query" placeholder="<?= Translate::Val('Search') ?>" name="q" autocomplete="off"><span class="search-icon"><button type="submit" class="icon-search nav-search" tabindex="-1"></button></span>
				</form></li>
				
			</ul>
		</div>
		<!-- <div class="setting-description mtm uiBoxYellow pam">Manage your personal employee settings.</div> -->
	</div></div>

	<div class="SettingCol-main">
		
		<div class="SettingCol-tableHeader"><div class="SettingCol-contentInner">
			<table class="settings-table admin"><thead><tr>
				<th class="name" data-col="0">Name</th>
				<th class="check" data-col="1">Enabled</th>
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
					<div class="empty-icon"><i class="icon-map-marker"></i></div>
					<div class="empty-title">No Results Found.</div>
				</div>
			</div>
		</div>
		

		<div class="SettingCol-footer ">
			<div class="SettingCol-contentInner clearfix">
				<ul class="lfloat SettingCol-headerActions clearfix">
					<li data-ref="pager" id="more-link"></li>
				</ul>
			</div>
		</div>
	</div>
</div>

<script type="text/javascript">
	
	var $el = {
		country: $('select#country'),
		province: $('select#province'),
		zone: $('select#zone'),
	}, is_stop = true;
	
	function changeProvince() {
		var val = $el.province.val();

		$.get( app.getUri( 'location/zoneList' ), {province: val}, function (res) {
			$el.zone.empty();
			$.each(res, function(i, obj) {
				$el.zone.append( $('<option>', {value: obj.id, text: obj.name}) );
			});

			$el.zone.parent().toggleClass('hidden_elem', res.length==0);

			$el.zone.trigger('change');
		}, 'json');
	}
	$el.province.change(function() {
		changeProvince();
	});
	

	function changeCountry() {
		var val = $el.country.val();

		$.get( app.getUri( 'location/provinceList' ), {country: val, enabled: 1}, function (res) {
			
			$el.province.empty();
			$.each(res, function(i, obj) {
				$el.province.append( $('<option>', { value: obj.id, text: obj.name}) );
			});
			$el.province.parent().toggleClass('hidden_elem', res.length==0);
			changeProvince();
		}, 'json');
	}

	$el.country.change(function() {
		changeCountry();
	});
	changeCountry();

</script>