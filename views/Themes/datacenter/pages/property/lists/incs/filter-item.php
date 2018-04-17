<div class="filter-menu mvm">


	<!-- Lease Type -->
	<div class="filter-item">
		<h3 class="filter-item__header">Lease Type</h3>
		<ul class="filter-item__lists">
			<li class="filter-item-react">
				<label class="checkbox"><input type="checkbox" name="property_for_rent" checked="" value="1"><span>For Rent</span></label>
				<label class="checkbox" style="margin-left: 10px;"><input type="checkbox" name="property_for_sale" value="1"><span>For Sale</span></label>
			</li>
		</ul>
	</div>

	<!-- Price per month -->
	<div class="filter-item">				
		<h3 class="filter-item__header clearfix">
			<span class="lfloat">Price range (THB)</span>
			<span class="rfloat"><input type="text" id="filter_price_from" name="filter_price_from" value="30,000" style="display: inline-block;width: 80px;height: auto;text-align: center;font-size: 13px;font-weight:normal;color: #000"> - <input type="text" id="filter_price_to" name="filter_price_to" value="150,000" style="display: inline-block;width: 80px;height: auto;text-align: center;font-size: 13px;font-weight:normal;color: #000"></span>
		</h3>
		<div class="irs-hide-topbar">
			<input style="visibility: hidden;" type="text" id="filterPrice" name="property_price">
		</div>
		
	</div>

	<!-- Bedroom -->
	<div class="filter-item">
							
		<h3 class="filter-item__header">Bedroom</h3>
		
		<ul class="filter-item__lists"><?php
		 for ($i=1; $i <= 4; $i++) {

			echo '<li class="filter-item-react" style="display: inline-block;width:50%">';

			echo '<span><label class="checkbox"><input type="checkbox" name="bedroom[]" value="'.$i.'"><span>'.$i.'</span></label></span>';

			if( $i > 1 ){
				echo '<span><label class="checkbox"><input type="checkbox" name="bedroom[]" value="'.$i.'"><span>'.$i.'+1</span></label></span>';
			}

			echo '</li>';
		} 


		echo '<li class="filter-item-react">';
			echo '<label class="checkbox"><input type="checkbox" name="bedroom[]" value="5"><span>5</span></label>';
			echo '<span><label class="checkbox"><input type="checkbox" name="bedroom[]" value="5"><span> > 5</span></label></span>';
		echo '</li>';


		?></ul>
	</div>
	
	<!-- Property Type -->
	<div class="filter-item">
		<h3 class="filter-item__header">Property Type</h3>
		<ul class="filter-item__lists"><?php
			

		?></ul>
	</div>

	<!-- Property Zone -->
	<div class="filter-item">
		<h3 class="filter-item__header">Property Zone</h3>
		<ul class="filter-item__lists"><?php
			

		?></ul>
	</div>

	<!-- Property Facilities -->
	<div class="filter-item">
		<h3 class="filter-item__header">Property Facilities</h3>
		<ul class="filter-item__lists"><?php
			

		?></ul>
	</div>

	<!-- Property Permissions -->
	<div class="filter-item">
		<h3 class="filter-item__header">Property Permissions</h3>
		<ul class="filter-item__lists"><?php
			

		?></ul>
	</div>

	<!-- Room Amenities -->
	<div class="filter-item">
		<h3 class="filter-item__header">Room Amenities</h3>
		<ul class="filter-item__lists"><?php
			

		?></ul>
	</div>

	<!-- Room offers -->
	<div class="filter-item">
		<h3 class="filter-item__header">Room offers</h3>
		<ul class="filter-item__lists"><?php
			
		?></ul>
	</div>

	

	<!-- Near -->
	<div class="filter-item">
		<h3 class="filter-item__header">Near</h3>
		<ul class="filter-item__lists"><?php
			
		?></ul>
	</div>

	<!-- Embassy -->
	<div class="filter-item">
		<h3 class="filter-item__header">Embassy</h3>
		<ul class="filter-item__lists"><?php
			
		?></ul>
	</div>


	<!-- Style -->
	<div class="filter-item">
		<h3 class="filter-item__header">Room Style</h3>
		<ul class="filter-item__lists"><?php
			

		?></ul>
	</div>
	
</div>