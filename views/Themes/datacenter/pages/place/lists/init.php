<?php

$this->model = 'place';
$this->pageURL = URL."{$this->model}/";
$this->pageTitle = ucfirst($this->model);
$this->pageIcon = 'map-marker';

$this->pagePermit = array(
	'add' => !empty($this->permit[$this->model]['add']),
	'edit' => !empty($this->permit[$this->model]['edit']),
	'del' => !empty($this->permit[$this->model]['del']),
);

# title
$title = array(
	0 => 

	  array('key'=>'check-box', 'text'=> '<label class="checkbox"><input id="checkboxes" type="checkbox"></label>' )
	  
	, array('key'=>'name', 'text'=>Translate::val('Place Name'))
	// , array('key'=>'qty tar', 'text'=>Translate::val('Partner')  )
	// , array('key'=>'qty tar', 'text'=>Translate::val('Company'), 'sort'=>'Company' )
	, array('key'=>'status', 'text'=> Translate::val( 'Total Rooms' ) )
	, array('key'=>'status', 'text'=> Translate::val( 'Total Venues' ) )
	, array('key'=>'status', 'text'=> Translate::val( 'Enabled' ) )
	, array('key'=>'date', 'text'=> Translate::val( 'Last Update' ), 'sort'=>'update_date' )

	, array('key'=>'actions', 'text'=>'' )
	
);

// $this->titleStyle = 'row-2';

$this->tabletitle = $title;
$this->getURL =URL."admin/{$this->model}/";
