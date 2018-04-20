<div class="filter-menu mvm searchbox__outer">

	<div class="searchbox">
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
		<div class="filter-item searchbox__row">				
			<h3 class="filter-item__header clearfix">
				<span class="lfloat">Bedroom</span>
				<span class="rfloat"><input type="text" id="filter_bedroom_from" name="filter_bedroom_from" value="1" class="inpit-tipprice"> - <input type="text" id="filter_bedroom_to" name="filter_bedroom_to" value="3" class="inpit-tipprice"></span>
			</h3>
			<div class="irs-hide-topbar">
				<input style="visibility: hidden;" type="text" id="filterBedroomSlider">
			</div>
			
		</div>
		
		<!-- Property Type -->
		<div class="filter-item">
			<h3 class="filter-item__header">Property Type</h3>
			<select id="type" class="inputtext" name="type">
				<option>-- All types --</option>
				<option value="apartment">Apartment</option><option value="condo">Condominium</option><option value="house">House</option>			
			</select>
		</div>

		<!-- Property Zone -->
		<div class="filter-item">
			<h3 class="filter-item__header">Property Zone</h3>
			<select id="type" class="inputtext" name="type">
				<option>-- All zones --</option>
				<option value="apartment">Apartment</option><option value="condo">Condominium</option><option value="house">House</option>			
			</select>
		</div>

	</div>

	<div class="searchbox__advance">
		<div class="searchbox__advance-wrap">
			<div class="searchbox__advance-content">

				<!-- Pet Friendly -->
				<div class="filter-item searchbox__row">
					<h3 class="filter-item__header">Pet Friendly</h3>
					<ul class="filter-item__lists">
						<li class="filter-item-react">
							<label class="checkbox"><input type="checkbox" value="1"><span>Cat</span></label>
							<label class="checkbox"><input type="checkbox" value="1"><span>Dog</span></label>
						</li>
					</ul>
				</div>

				<!-- Property Facilities -->
				<div class="filter-item">
					<div class="filter-item__header clearfix">
						<h3 class="lfloat">Property Facilities</h3>
						<button type="button" class="rfloat clear">Clear</button>
					</div>
					<ul class="filter-item__lists column-2">
						<?php for ($i=0; $i < 4; $i++) { 
						?><li class="filter-item-react">
							<label class="checkbox"><input type="checkbox" value="1"><span>Cat</span></label>
						</li><?php } ?>
					</ul>
				</div>

				<!-- Embassy -->
				<div class="filter-item">
					<h3 class="filter-item__header">Property Embassy</h3>
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
				<div class="filter-item searchbox__row">
					<h3 class="filter-item__header">Property Near Train</h3>
					<div class="filter-item__lists-sub">
						<h3 class="filter-item__header">BTS</h3>
						<ul class="filter-item__lists column-2">
							<?php for ($i=0; $i < 4; $i++) { 
							?><li class="filter-item-react">
								<label class="checkbox"><input type="checkbox" value="1"><span>Cat</span></label>
							</li><?php } ?>
						</ul>
					</div>

					<div class="filter-item__lists-sub">
						<h3 class="filter-item__header">MRT</h3>
						<ul class="filter-item__lists column-2">
							<?php for ($i=0; $i < 4; $i++) { 
							?><li class="filter-item-react">
								<label class="checkbox"><input type="checkbox" value="1"><span>Cat</span></label>
							</li><?php } ?>
						</ul>
					</div>

					<div class="filter-item__lists-sub">
						<h3 class="filter-item__header">Airport Rail Link</h3>
						<ul class="filter-item__lists column-2">
							<?php for ($i=0; $i < 4; $i++) { 
							?><li class="filter-item-react">
								<label class="checkbox"><input type="checkbox" value="1"><span>Cat</span></label>
							</li><?php } ?>
						</ul>
					</div>
				</div>

				


				<!-- Style -->
				<div class="filter-item">
					<h3 class="filter-item__header">Room Style</h3>
					<ul class="filter-item__lists column-2">
						<?php for ($i=0; $i < 4; $i++) { 
						?><li class="filter-item-react">
							<label class="checkbox"><input type="checkbox" value="1"><span>Cat</span></label>
						</li><?php } ?>
					</ul>
				</div>
			</div>

		</div>
		<!-- end: searchbox__advance-content -->

		<div class="searchbox__advance-trigger"><button class="searchbox__advance-trigger-text" type="button"><span>Advance Search</span> <i class="icon-angle-down"></i></button></div>
	
	</div>

</div>
<!-- end: searchbox__outer -->