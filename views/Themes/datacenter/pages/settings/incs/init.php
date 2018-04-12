<?php

$this->pageURL = URL.'admin/settings/';
$this->count_nav = 0;
$menu = array();


/* Preferences */
$sub = array();
$sub[] = array('text' => Translate::Menu('Email Settings'),'key' => 'settings_email','url' => $this->pageURL.'email', 'top_key'=>'blog_');

foreach ($sub as $key => $value) {
	if( empty($this->permit[ $value['key'] ]['view'] ) ) unset( $sub[$key] );
}
if( !empty($sub) ){
	$this->count_nav+=count($sub);
	$menu[] = array('text' => 'Preferences', 'url' => $this->pageURL.'settings/blog/forum', 'sub' => $sub);
}


/* Locations */
$sub = array();
// $sub[] = array('text' => Translate::Menu('Region'),'key' => 'settings_location_region','url' => $this->pageURL.'location/region');
$sub[] = array('text' => Translate::Menu('Country'),'key' => 'settings_location_country', 'url' => $this->pageURL.'location/country');
// $sub[] = array('text' => Translate::Menu('Geography'),'key' => 'settings_location_geography', 'url' => $this->pageURL.'location/geography');
$sub[] = array('text' => Translate::Menu('Province'),'key' => 'settings_location_province', 'url' => $this->pageURL.'location/province');
$sub[] = array('text' => Translate::Menu('Zone'),'key' => 'settings_location_zone', 'url' => $this->pageURL.'location/zone');
$sub[] = array('text' => Translate::Menu('District'),'key' => 'settings_location_district', 'url' => $this->pageURL.'location/district');

foreach ($sub as $key => $value) {
	if( empty($this->permit[ $value['key'] ]['view'] ) ) unset( $sub[$key] );
}
if( !empty($sub) ){
	$this->count_nav+=count($sub);
	$menu[] = array('text' => 'Customize Locations', 'url' => $this->pageURL.'settings/location', 'sub' => $sub);
}

/* Property */
$this->sub['property'] = array();
$this->sub['property'][] = array('text'=>Translate::Menu('Category'),'key' => 'settings_property_type', 'url' => $this->pageURL.'property/type', 'top_key'=>'property', 'description'=> 'หมวดหมู่: สถานที่ต่างๆ เช่นโรงแรม, บ้าน, รีสอรทส์, โรงเรียน ฯลฯ');
$this->sub['property'][] = array('text' => Translate::Menu('Facility Types'),'key' => 'settings_property_facility_type', 'url' => $this->pageURL.'property/facility/types', 'top_key'=>'property', 'description'=> 'ประภท: จำแนจกลุ่มสิ่งอำนวยความสดวก ให้กับสถานที่นั้นๆ');
$this->sub['property'][] = array('text' => Translate::Menu('Facility'),'key' => 'settings_property_facility','url' => $this->pageURL.'property/facility', 'top_key'=>'property','description'=>'สิ่งอำนวยความสดวก: บอกลักษณะของสถานที่นั้นๆ แบบเจาะจง');

foreach ($this->sub['property'] as $key => $value) {
	if( empty($this->permit[ $value['key'] ]['view'] ) ) unset( $this->sub['property'][$key] );
}
if( !empty($this->sub['property']) ){
	$this->count_nav+=count($this->sub['property']);
	$menu[] = array('text' => 'Customize Property', 'url' => $this->pageURL.'property', 'sub'=>$this->sub['property']);
}


/* Room */
$sub = array();
// $sub[] = array('text' => Translate::Menu('Category'),'key' => 'settings_room_category', 'url' => $this->pageURL.'room/category', 'top_key'=>'blog_');
$sub[] = array('text' => Translate::Menu('Offer Types'),'key' => 'settings_room_offers', 'url' => $this->pageURL.'room/offer/types', 'top_key'=>'blog_');
$sub[] = array('text' => Translate::Menu('Offer'),'key' => 'settings_room_offers_type', 'url' => $this->pageURL.'room/offers', 'top_key'=>'blog_');

foreach ($sub as $key => $value) {
	if( empty($this->permit[ $value['key'] ]['view'] ) ) unset( $sub[$key] );
}
if( !empty($sub) ){
	$this->count_nav+=count($sub);
	$menu[] = array('text' => 'Customize Room', 'url' => $this->pageURL.'property', 'sub' => $sub);
}


/* Data Management */
$sub = array();
$sub[] = array('text' => Translate::Menu('import'),'key' => 'settings_import', 'url' => $this->pageURL.'import', 'top_key'=>'blog_');
$sub[] = array('text' => Translate::Menu('export'),'key' => 'settings_export', 'url' => $this->pageURL.'export', 'top_key'=>'blog_');

foreach ($sub as $key => $value) {
	if( empty($this->permit[ $value['key'] ]['view'] ) ) unset( $sub[$key] );
}
if( !empty($sub) ){
	$this->count_nav+=count($sub);
	$menu[] = array('text' => 'Data Management', 'url' => $this->pageURL.'data-management', 'sub' => $sub);
}