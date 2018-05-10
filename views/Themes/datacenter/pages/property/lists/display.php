<?php

// 0=> array('name'=>'Chong 1') 
$propertySearchOptions = array(
	'recentsearchs' => array( )
);


?><div id="searchPage" class="search__has-listCol" data-plugins="propertySearch" data-options="<?= $this->fn->stringify( $propertySearchOptions ) ?>">

	<div class="search-box__container">
		<div class="container">
			<div class="search-box__outer">
				<div class="search-box__wrap clearfix ">
					<div class="search-box__item filter-keyword">

						<div class="search-box-input" role="searchbox">
							<lable class="filter-keyword-icon" for="keyword"><i class="icon-search"></i></lable>
							<input id="keyword" class="input inputtext input-search" type="text" name="keyword" placeholder="Search property?" maxlength="128" autocomplete="off" autofocus role="input-search">

							<div class="search-box__controls">
								<div class="search-box__control clear" data-searchbox-action="clear"></div>
								<div class="search-box__control loader loader-spin-wrap"><div class="loader-spin"></div></div>
							</div>
						
							<div class="search-dropdown">
								
								<div ref="recent-searchs">
									<div class="search-dropdown-header">Recent searchs</div>
									<ul class="search-dropdown-items" data-searchbox-listsbox="recentsearchs" role="recentsearchs"></ul>
								</div>

								<div style="display: none;">
									<ul class="search-dropdown-items" data-searchbox-listsbox="building"></ul>
								</div>

								<div style="display: none;">
									<div class="search-dropdown-header">Unit</div>
									<ul class="search-dropdown-items" data-searchbox-listsbox="property"></ul>
								</div>

								<div style="display: none;">
									<div class="search-dropdown-header">Owner</div>
									<ul class="search-dropdown-items" data-searchbox-listsbox="owner"></ul>
								</div>

								<div style="display: none;">
									<div class="search-dropdown-header">Contact</div>
									<ul class="search-dropdown-items" data-searchbox-listsbox="contact"></ul>
								</div>
							</div>
						</div>
					</div>
					<div class="search-box__item divider"></div>
					<div class="search-box__item filter-action"><button class="input btn btn-orange btn-submit">Search</button></div>
				</div>

				<table>
					<tbody>
						<tr>
							<td><div><strong>Total results:</strong> <span class="fcblue">2,551</span> <span>properties found</span></div></td>
							<td></td>
							<td style="white-space: nowrap;width: 50px;padding: 0 6px;font-weight: bold;font-size: 11px;">Sort by:</td>
							<td style="white-space: nowrap;width: 100px;border: 1px solid #ccc;background-color: #fff">
								<div class="sort-bar clearfix">
									<button type="button" class="sort-bar__item active" data-action="sort" data-value="property.updatedate DESC"><div class="sort-bar__inner"><span>Last update</span></div></button><button type="button" class="sort-bar__item" data-action="sort" data-value="state ASC,property.updatedate DESC"><div class="sort-bar__inner"><span>Available</span></div></button><button type="button" class="sort-bar__item" data-action="sort" data-value="state ASC,property.price DESC"><div class="sort-bar__inner"><span>Price</span></div></button><button type="button" class="sort-bar__item" data-action="sort" data-value="type.name ASC,state ASC,property.updatedate DESC"><div class="sort-bar__inner"><span>Type</span></div></button><button type="button" class="sort-bar__item" data-action="sort" data-value="zone.name ASC,state ASC,property.updatedate DESC"><div class="sort-bar__inner"><span>Zone</span></div></button>
								</div>
							</td>
						</tr>
					</tbody>
				</table>
				

			</div>
		</div>
	</div>

	<div class="searchPage-wrapper container">


		<div id="searchPage-LeftColumn" class="searchPage-LeftColumn">
			
			<?php include_once 'incs/filter-item.php'; ?>

			<ul style="position: absolute;">
				<li style="">
					<a></a>
				</li>
			</ul>
			
		</div>
		<div id="searchPage-RightColumn" class="searchPage-RightColumn">

			<div style="padding-left: 30px;padding-top: 24px;padding-bottom: 24px;">

				<div class="property-items">
					<div class="property-lists" ref="property-listsbox">
						<?php for ($i=0; $i < 10; $i++) { ?>
						<?php include 'incs/list-item.php'; ?>

						<?php } ?>
					</div>

					
					<div class="property-items_alert-loader">
						<div class="loader-spin-wrap" style="margin-left: auto;margin-right: auto;"><div class="loader-spin"></div></div>
						<div class="tac mts">Loading...</div>
					</div>
				</div>
			</div>
		</div>
	</div>


	<div class="collection-drawer-layout-container active">
		<div class="collection-drawer">
			<div class="collection-drawer-header clearfix">
				<div style="white-space: nowrap;width: 30px;padding-left: 12px;padding-right: 12px;">
					<div class="collection-drawer-header-label fwb">2 Selected wait listing</div>
				</div>

				<div>
					<table>
						<tr>
							<td>

								<div class="" style="position: relative;">
									<button style="border-radius: 0;width: 100%;text-align: left;position: relative;padding-right: 22px;" class="btn"><span class="mrs">21385 - 154454441554545</span><i class="icon-angle-down" style="position: absolute;right: 6px;top: 7px"></i></button>
									<div style="position: absolute;bottom: 100%;left: 0;right: 0;border: 1px solid rgba(82,168,236,.75);box-shadow: 0 -2px 6px rgba(0,0,0,.1);border-bottom: initial;background-color: #fff;color: #000;    width: 322px;">
										<div class="propertyListingMenu">

											<!-- background: #0a96eb;color: #fff; -->
											<div class="clearfix" style="padding: 6px 12px;border-bottom: 1px solid #ccc;"><i class="icon-plus"></i><span class="mls fwb">Create new</span></div>

											<div role="search"><form class="t1-form form-search js-search-form" action="/search" id="global-nav-search">
											    <label class="visuallyhidden" for="search-query">Search query</label>
											    <input class="search-input" type="text" id="search-query" placeholder="Search listing by code" name="q" autocomplete="off">
											    <span class="search-icon js-search-action">
											      <button type="submit" class="icon icon-search" tabindex="0">
											        <span class="visuallyhidden">Search</span>
											      </button>
											    </span>

											</form></div>

											<div class="propertyListingMenu__content">
												<ul class="propertyListingList">
													<?php for ($i=0; $i < 10; $i++) { ?>
													<li class="menu-item" data-id="21385">
														<div class="anchor clearfix">
															<div class="code lfloat mrm"><span class="fwb">#21385</span><div class="fss">19 Items</div></div>
															<div class="content"><div class="spacer"></div><div class="massages"><div class="fullname">ถ่ายรูปหลังสวน/พี่เต่า</div><div class="dics"><span class="date fcg fsm"><i class="date-i icon-clock-o"></i><span class="date-str mls"><span class="timestamp" data-time="1525318299" title="3 พฤษภาคม 2561 เวลา 10.39น.">3 พ.ค.</span></span> - <span class="">Peem</span></span></div></div></div>
													</div></li>
													<?php } ?>
												</ul>
											</div>

											<div class="propertyListingFooter"><div class="propertyListingAlert_loader">Loading...</div><div class="propertyListingAlert_empty">No results found.</div><div class="propertyListingAlert_error">Error loading listing, <a type="button" data-action="tryagain">Try again</a></div></div>

										</div>
									</div>
								</div>
								<!-- <select class="inputtext" style="background-color: #fff;width: 100%">
									<option>Create new:</option>
									<optgroup label="Property Listing" id="appendList">
										<?php for ($i=0; $i < 10; $i++) { ?>
										<option>10001<?=$i?> - Test 19 Items sdf ds/ sddsf</option>
										<?php } ?>
									</optgroup>
								</select> -->	
							</td>
							<td style="display: none;">
								<input type="text" name="" class="inputtext" placeholder="Create new?" style="display: inline-block;background-color: #fff;">
							</td>
						</tr>
					</table>
					
					
				</div>

				<div style="white-space: nowrap;width: 30px;padding-left: 10px">
					<button type="button" class="btn" style="display: inline-block;vertical-align: top;border-radius: 50%;width: 30px;padding: 0"><i class="icon-plus"></i></button>
				</div>
				
				<div style="    white-space: nowrap;width: 30px;padding-right: 12px;">
					<button class="collection-drawer-trigger" type="button"><i class="icon-angle-up"></i></button>
				</div>
				
			</div>
		</div>
	</div>
</div>


<script type="text/javascript" src="<?=JS?>plugins/rangeSlider.js"></script>
<script type="text/javascript">


	var $LeftColumn = $('#searchPage-LeftColumn');

	$('#searchPage').css({
		paddingTop: $('.search-box__container').outerHeight()
	});

	var LeftColumnTop = $('#filter-topbar').outerHeight() + $('#header-primary').outerHeight();

	if( !$('#searchPage').hasClass('search__has-listCol') ){
		LeftColumnTop += $('.search-box__container').outerHeight();
	}

	$LeftColumn.css({
		top: LeftColumnTop,
	});


	var $filterPriceSlider = $('#filterPrice'),
		$filterPriceFrom = $('#filter_price_from'),
		$filterPriceTo = $('#filter_price_to');

	$filterPriceSlider.rangeSlider({
		type:"double",
		grid: true,
		min: 0,
		max: 400,

    	from: 30,
   		to: 400,

   		// 'width' : 200,
   		prefix: "฿",
   		postfix: "k",
   		// keyboard: true,

   		hide_min_max: true,
		hide_from_to: true,
		onStart: uppdatePrice,
	    onChange: uppdatePrice,
	    onFinish: uppdatePrice,
	    onUpdate: uppdatePrice

		/*prettify: function (num) {
	        console.log( num );
	    }*/
	});


	$('#filter_price_from, #filter_price_to').on('change', function () {
		
		var slider = $filterPriceSlider.data("rangeSlider"),
			from = $('#filter_price_from').val(),
			to = $('#filter_price_to').val();


		var fromVal = parseInt( from.replace(",", "") ),
			toVal = parseInt( to.replace(",", "") );


		slider.update({
            from: (fromVal / 1000),
            to: (toVal / 1000)
        });

        $(this).val( PHP.number_format( $(this).val() ) );
	}).keypress(function(e) {
		if( (e.keyCode >= 48 && e.keyCode <= 57) ) {}
		else{
			e.preventDefault();
		}
	}).keyup(function () {
		$(this).val( PHP.number_format( $(this).val() ) );
	});

	function uppdatePrice(data) {
		$filterPriceFrom.val( PHP.number_format( data.from_pretty + '000' ) );
	    $filterPriceTo.val( PHP.number_format( data.to_pretty + '000' ) );
	}

	$('[name=property_for_sale]').on('change', function () {
		var slider = $filterPriceSlider.data("rangeSlider"),
			is = $(this).prop('checked');

		if( is ){
			slider.update({
				max: 100000,
				to: 50000
			});
		}
		else{
			slider.update({
				max: 400	
			});
		}
	});


	var $filterBedroomSlider = $('#filterBedroomSlider');

    $filterBedroomSlider.rangeSlider({
        type:"double",
        grid: true,
        grid_num: 7,
        min: 1,
        max: 8,

        from: 1,
        to: 3,

        hide_min_max: true,
        hide_from_to: true,
    });

	// Client ID and API key from the Developer Console
	/*var APP_ID = '<YOUR_USER_ID>';
	var options = {};

	function handleClientLoad() {
		gapi.load('property', init);
	}

	function init() {

		gapi.init({
			appId: APP_ID,
          	cookie: true,

          	version: 'v1.1', // use graph api version 1.1
		}).then(function () {
			findProperty( options );
		});
	}

	function findProperty( options ) {
		gapi.property.find(options, listProperty);
	}

	function getProperty( id ) {
		gapi.property.get(id);
	}
	function listProperty() {
		
	}*/

	// Load the SDK asynchronously

	$('.searchbox__advance-trigger-text').click(function() {

		var $outer = $('.searchbox__outer'),
			is = $outer.hasClass('has-advance');

		$outer.toggleClass('has-advance', !is);
		
		$('.searchbox__advance-wrap').css({
			height: is ? 0: $(window).height() - ( $outer.outerHeight() + $outer.offset().top + 50 ),
			overflowY: is ? 'hidden': 'auto'
		});
	});

</script>

<!-- connect -->
<!-- <script async defer src="http://localhost/tpg.apis/js/api-demo.js" onload="this.onload=function(){};handleClientLoad()"></script> -->

<!-- <script async defer src="http://localhost/apis.tpg/js/api.js"
  onload="this.onload=function(){};handleClientLoad()"
  onreadystatechange="if (this.readyState === 'complete') this.onload()">
</script>
 -->
