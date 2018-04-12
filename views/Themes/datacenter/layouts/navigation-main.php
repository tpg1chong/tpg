<?php

$this->pageURL = URL.'admin/';
$this->permit = $this->getPage('auth');


$nav = array(
	0=> array(

		// Overview
		  array('key'=>'dashboard', 'text'=> 'Dashboard', 'link'=>$this->pageURL.'overview', 'icon'=>'area-chart')
		, array('key'=>'calendar', 'text'=> Translate::Val('Calendar'), 'link'=>$this->pageURL.'calendar', 'icon'=>'calendar-o')
		// , array('key'=>'blog_manager', 'text'=> Translate::Val('Blog'), 'link'=>$this->pageURL.'blog', 'icon'=>'newspaper-o')
	)
	, array(

		// Site
		  array('key'=>'place', 'text'=> Translate::Val('Place'), 'link'=>$this->pageURL.'place', 'icon'=>'map-marker')
		  // array('key'=>'location', 'text'=> Translate::Val('Place'), 'link'=>$this->pageURL.'location', 'icon'=>'map-marker')
		// , array('key'=>'property_manager', 'text'=> Translate::Val('Property'), 'link'=>$this->pageURL.'property', 'icon'=>'home')
		, array('key'=>'promotions', 'text'=> Translate::Val('Promotions'), 'link'=>$this->pageURL.'promotions', 'icon'=>'tags')

	)
	/*, array(

		// Site
		  array('key'=>'member_manager', 'text'=> Translate::Menu('Member'), 'link'=>$this->pageURL.'member', 'icon'=>'users')
		, array('key'=>'inbox', 'text'=> Translate::Menu('Inbox'), 'link'=>$this->pageURL.'inbox', 'icon'=>'envelope-o')

	)*/

	, array(

		// Site
		  array('key'=>'partner', 'text'=> Translate::Menu('Partner'), 'link'=>$this->pageURL.'partner', 'icon'=>'users')
		// , array('key'=>'inbox', 'text'=> Translate::Menu('Inbox'), 'link'=>$this->pageURL.'inbox', 'icon'=>'envelope-o')

	), array(

		// Site
		  array('key'=>'booking', 'text'=> Translate::Menu('Booking'), 'link'=>$this->pageURL.'booking', 'icon'=>'check-square-o')
		// , array('key'=>'inbox', 'text'=> Translate::Menu('Inbox'), 'link'=>$this->pageURL.'inbox', 'icon'=>'envelope-o')

	)

	, array(
		  array('key'=>'site_manager', 'text'=> 'Site Manager','link'=>$this->pageURL.'site','icon'=>'object-ungroup')
		, array('key'=>'business', 'text'=> 'Business Info','link'=>$this->pageURL.'business','icon'=>'cog')
		// authorization
		, array('key'=>'authorization', 'text'=> 'Roles & Permissions', 'link'=>$this->pageURL.'account/authorization','icon'=>'users' )
		, array('key'=>'my','text'=> 'Account Settings','link'=>$this->pageURL.'account/settings','icon'=>'user-circle')
	)

	, array(
		  array('key'=>'settings', 'text'=> 'Settings','link'=>$this->pageURL.'settings','icon'=>'cog')
	)
);





$image = '';
if( !empty($this->me['image_url']) ){
	$image = '<div class="avatar lfloat mrm"><img class="img" src="'.$this->me['image_url'].'" alt="'.$this->me['fullname'].'"></div>';
}
else{
	$image = '<div class="avatar lfloat no-avatar mrm"><div class="initials"><i class="icon-user"></i></div></div>';
}

echo '<div class="navigation-main-bg navigation-trigger"></div>';
echo '<nav class="navigation-main" role="navigation"><a class="navigation-btn-trigger navigation-trigger"><span></span></a>';

echo '<div class="navigation-main-header"><div class="anchor clearfix">'.$image.'<div class="content"><div class="spacer"></div><div class="massages"><div class="fullname">'.$this->me['name'].'</div><div class="subname">'.$this->me['role_name'].'</div></div></div></div></div>';

echo '<div class="navigation-main-content">';



foreach ($nav as $items) {

	foreach ($items as $key => $value) {
		if( empty($this->permit[$value['key']]['view']) ) unset($items[$key]);
	}
	if( !empty($items)){
		echo $this->fn->manage_nav($items, $this->getPage('on'));
	}

}

echo '</div>';

	echo '<div class="navigation-main-footer">';


echo '<ul class="navigation-list">'.

	'<li class="clearfix">'.
		'<div class="navigation-main-footer-cogs">'.
			'<a data-plugins="dialog" href="'.$this->pageURL.'logout/?next='.$this->pageURL.'"><i class="icon-power-off"></i><span class="visuallyhidden">Log Out</span></a>'.
			// '<a href="'.URL.'logout/admin"><i class="icon-cog"></i><span class="visuallyhidden">Settings</span></a>'.
		'</div>'.
		'<div class="navigation-brand-logo clearfix">'.( !empty( $this->system['title'] ) ? $this->system['title']:'' ).'</div>'.
	'</li>'.
'</ul>';

echo '</div>';


echo '</nav>';
