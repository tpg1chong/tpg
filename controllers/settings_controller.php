<?php

class Settings_Controller extends Controller {

    public function __construct() {
        parent::__construct();
    }

    public function index($section='account') {
        
    	$this->view->setData('section', $section);
    	$this->view->render('settings/display');
    }

    public function account()
    {
    	$this->index('account');
    }


}
