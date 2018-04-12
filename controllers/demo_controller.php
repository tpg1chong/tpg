<?php

class Demo_Controller extends Controller {

    public function __construct() {
        parent::__construct();
    }

    public function index() {
        
    	$this->view->elem('body')->addClass('home');
        $this->view->setPage('has_home', 1);

        $this->view->render('design/home');
    }

    public function search()
    {
        $this->view->elem('body')->addClass('has-top-banner');
    	$this->view->render('design/hotel-list');
    }


    public function hotel($active='')
    {
        $this->view->elem('body')->addClass('has-top-banner');
        
    	if($active='profile'){
    		$this->view->render('design/hotel-profile');
    	}
    	else{
    		$this->search();
    	}
    }
}
