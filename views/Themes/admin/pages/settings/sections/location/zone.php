<?php

$url = URL.'property/';

?><div data-load="<?=URL?>location/zoneList?has_item=1" stop class="SettingCol offline">

	<div class="SettingCol-header"><div class="SettingCol-contentInner">
		<div class="clearfix">
			<ul class="clearfix lfloat SettingCol-headerActions">
				<li><h2><span><?= Translate::Val('Zone') ?></span></h2></li>
				<li class="divider"></li>
				<li><a data-action="refresh" class="btn"><i class="icon-refresh"></i></a></li>
				
			</ul>
			
			<ul class="rfloat SettingCol-headerActions clearfix">
				<li><a class="btn btn-blue" data-plugins="lightbox" href="<?=URL?>location/add/zone"><i class="icon-plus mrs"></i><span><?=$this->lang->translate('Add New')?></span></a></li>
			</ul>

		
		</div>

		<div class="mtm clearfix">
			<ul class="lfloat SettingCol-headerActions clearfix">
				
				<li><label class="label" for="country">Country:</label><select id="country" class="inputtext" name="country" ref="selector" stop><?php foreach ($this->countryList as $key => $value) {
					echo '<option value="'.$value['id'].'">'.$value['name'].'</option>';
				} ?></select></li>
				<li><label class="label" for="country">Province:</label><select id="province" class="inputtext" name="province" ref="selector"></select></li>
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
	</div>

	<div class="SettingCol-footer ">
		<div class="SettingCol-contentInner clearfix">
			<ul class="lfloat SettingCol-headerActions clearfix">
				<li data-ref="pager" id="more-link"></li>
			</ul>
		</div>
	</div>
</div>

<script type="text/javascript">
	
	var $el = {
		country: $('select#country'),
		province: $('select#province'),
	}
	
	function changeCountry() {
		var val = $el.country.val();

		$.get( app.getUri( 'location/provinceList' ), {country: val, enabled: 1}, function (res) {
			
			$el.province.empty();
			$.each(res, function(i, obj) {
				$el.province.append( $('<option>', { value: obj.id, text: obj.name}) );
			});

			$el.province.parent().toggleClass('hidden_elem', res.length==0);

			$el.province.trigger('change');
		}, 'json');
	}

	$el.country.change(function() {
		changeCountry();
	});

	setTimeout( function () {
		changeCountry();
	}, 3);


	$('body').delegate(':input[data-action-update=checked]', 'change', function (e) {
		var $this=$(this), id = $this.closest('tr').attr('data-id');

		$.get( app.getUri('location/update/zone'), {
			id: id,
			name: $this.attr('name'),
			value: $this.prop('checked') ? 1: 0
		});
	});

</script>