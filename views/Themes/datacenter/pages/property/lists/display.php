<div id="searchPage">

	<div class="search-box__container">
		<div class="container">
			<div class="search-box__wrap clearfix ">
				<div class="search-box__item filter-keyword">
					<lable class="filter-keyword-icon" for="keyword"><i class="icon-search"></i></lable>
					<input id="keyword" class="input inputtext input-search" type="text" name="keyword" placeholder="Search Keyword?" maxlength="128" autocomplete="off" autofocus>
				</div>
				<div class="search-box__item divider"></div>
				<div class="search-box__item filter-action"><button class="input btn btn-orange btn-submit">Search</button></div>
			</div>
		</div>
	</div>

	<div class="searchPage-wrapper container">


		<div id="searchPage-LeftColumn" class="searchPage-LeftColumn">
			
			<?php include_once 'incs/filter-item.php'; ?>
			
		</div>
		<div id="searchPage-RightColumn" class="searchPage-RightColumn">

			<div style="padding-left: 30px;padding-top: 24px;padding-bottom: 24px;">

				<table>
					<tbody>
						<tr>
							<td><div>Total results: 2,551 properties found</div></td>
							<td></td>
							<td style="white-space: nowrap;width: 50px;background-color: #ccc;border: 1px solid #ccc;padding: 0 6px">Sort by:</td>
							<td style="white-space: nowrap;width: 100px;border: 1px solid #ccc;background-color: #fff">
								<div class="sort-bar clearfix">
									<button type="button" class="sort-bar__item active" data-action="sort" data-value="property.updatedate DESC"><div class="sort-bar__inner"><span>Last update</span></div></button>
									<button type="button" class="sort-bar__item" data-action="sort" data-value="state ASC,property.updatedate DESC"><div class="sort-bar__inner"><span>Available</span></div></button>
									<button type="button" class="sort-bar__item" data-action="sort" data-value="state ASC,property.price DESC"><div class="sort-bar__inner"><span>Price</span></div></button>
									<button type="button" class="sort-bar__item" data-action="sort" data-value="type.name ASC,state ASC,property.updatedate DESC"><div class="sort-bar__inner"><span>Type</span></div></button>
									<button type="button" class="sort-bar__item" data-action="sort" data-value="zone.name ASC,state ASC,property.updatedate DESC"><div class="sort-bar__inner"><span>Zone</span></div></button>
								</div>
							</td>
						</tr>
					</tbody>
				</table>
				

				<div class="property-items has-loading">
					<div class="property-lists" ref="listsbox">
						<?php for ($i=0; $i < 10; $i++) { ?>
						<?php include 'incs/list-item.php'; ?>

						<?php } ?>
					</div>

					
					<div class="property-items_alert-loader">Loading...</div>
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
	$LeftColumn.css({
		top: $('.search-box__container').outerHeight() + $('#filter-topbar').outerHeight() + $('#header-primary').outerHeight(),
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
