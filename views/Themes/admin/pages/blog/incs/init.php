<?php

$this->pageURL = URL.'admin/blog/';
$this->count_nav = 5;
$menu = array();



$sub = array();
$sub[] = array('key'=>'published', 'text'=>'Published Posts', 'url' => $this->pageURL.'published');
$sub[] = array('key'=>'scheduled', 'text'=>'Scheduled Posts', 'url' => $this->pageURL.'scheduled');
$sub[] = array('key'=>'drafts', 'text'=>'Drafts', 'url' => $this->pageURL.'drafts');
$sub[] = array('key'=>'expiring', 'text'=>'Expiring Posts', 'url' => $this->pageURL.'expiring');


$this->count_nav+=count($sub);
$menu[] = array('text' => 'Posts', 'url' => '', 'sub' => $sub);


/* System */
$sub = array();
$sub[] = array('key'=>'forum', 'text'=>'Forum', 'url' => $this->pageURL.'forum');
$sub[] = array('key'=>'category', 'text'=>'Category', 'url' => $this->pageURL.'category');

$this->count_nav+=count($sub);
$menu[] = array('text' => 'Management', 'url' => '', 'sub' => $sub);

