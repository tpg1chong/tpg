<?php


$this->pageURL = URL.'admin/location/';
$this->count_nav = 0;
$menu = array();


$sub = array();
$sub[] = array('key'=>'place', 'text'=>'Places', 'url' => $this->pageURL.'place');
$sub[] = array('key'=>'create', 'text'=>'+ Create', 'url' => $this->pageURL.'create');
$this->count_nav+=count($sub);
$menu[] = array('text' => 'Places', 'url' => '', 'sub' => $sub);

$sub = array();
$sub[] = array('key'=>'category', 'text'=>'Category', 'url' => $this->pageURL.'category');
$sub[] = array('key'=>'type', 'text'=>'Type', 'url' => $this->pageURL.'type');
$sub[] = array('key'=>'facilities', 'text'=>'Facilities', 'url' => $this->pageURL.'facilities');
$sub[] = array('key'=>'payment_options', 'text'=>'Payment Options', 'url' => $this->pageURL.'payment_options'); // การชำระเงิน
$sub[] = array('key'=>'transportation', 'text'=>'Transportation', 'url' => $this->pageURL.'transportation'); // ใกล้ ขนส่ง

$this->count_nav+=count($sub);
$menu[] = array('text' => 'Place Management', 'url' => '', 'sub' => $sub);

/*location*/
$sub = array();
$sub[] = array('key'=>'region', 'text'=>'Region', 'url' => $this->pageURL.'region');
$sub[] = array('key'=>'country', 'text'=>'Country', 'url' => $this->pageURL.'country');
$sub[] = array('key'=>'geography', 'text'=>'Geography', 'url' => $this->pageURL.'geography'); //ภูมิภาค
$sub[] = array('key'=>'city', 'text'=>'City', 'url' => $this->pageURL.'city');



$this->count_nav+=count($sub);
$menu[] = array('text' => 'Location Management', 'url' => '', 'sub' => $sub);
