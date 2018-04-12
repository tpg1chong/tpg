<?php

$this->model = 'partner';
$this->pageURL = URL."{$this->model}/";
$this->pageTitle = ucfirst($this->model);
$this->pageIcon = 'user-circle-o';

$this->pagePermit = array(
	'add' => !empty($this->permit[$this->model]['add']),
	'edit' => !empty($this->permit[$this->model]['edit']),
	'del' => !empty($this->permit[$this->model]['del']),
);

# title
$title = array(
	0 => 

	  array('key'=>'check-box', 'text'=> '<label class="checkbox"><input id="checkboxes" type="checkbox"></label>' )
	  
	, array('key'=>'name', 'text'=>Translate::val('First Name'), 'sort'=>'name')
	/*, array('key'=>'qty tar', 'text'=>Translate::val('Title'), 'sort'=>'title'  )
	, array('key'=>'qty tar', 'text'=>Translate::val('Company'), 'sort'=>'Company' )*/
	, array('key'=>'email', 'text'=> Translate::val( 'Email' ), 'sort'=>'Email' )
	, array('key'=>'phone', 'text'=> Translate::val( 'Phone' ), 'sort'=>'Phone' )
	, array('key'=>'status', 'text'=> Translate::val( 'Enabled' ) )
	, array('key'=>'date', 'text'=> Translate::val( 'Last signed in' ), 'sort'=>'lastvisit' )

	, array('key'=>'actions', 'text'=>'' )
	
);

// $this->titleStyle = 'row-2';

$this->tabletitle = $title;
$this->getURL =URL."admin/{$this->model}/";
