<?php

$this->pageURL = URL.'admin/property/';
$this->count_nav = 0;
$menu = array();



$sub = array();
$sub[] = array('key'=>'available', 'text'=>'Available', 'url' => $this->pageURL.'available');
$sub[] = array('key'=>'not_available', 'text'=>'Not Available', 'url' => $this->pageURL.'not_available');
$sub[] = array('key'=>'drafts', 'text'=>'Drafts', 'url' => $this->pageURL.'drafts');
$sub[] = array('key'=>'promotions', 'text'=>'Promotions', 'url' => $this->pageURL.'promotions');




$this->count_nav+=count($sub);
$menu[] = array('text' => 'Property', 'url' => '', 'sub' => $sub);


/* System */
$sub = array();

$sub[] = array('key'=>'room_type', 'text'=>'Room Type', 'url' => $this->pageURL.'room_type'); // สิ่งอำนวยความสะดวก
$sub[] = array('key'=>'amenities', 'text'=>'Room Amenities', 'url' => $this->pageURL.'amenities'); // สิ่งอำนวยความสะดวก
$sub[] = array('key'=>'offers', 'text'=>'Room Offers', 'url' => $this->pageURL.'offers'); // บริการ

$this->count_nav+=count($sub);
$menu[] = array('text' => 'Management', 'url' => '', 'sub' => $sub);
