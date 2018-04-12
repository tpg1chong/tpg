<?php

class Company_Controller extends Controller {

    public function __construct() {
        parent::__construct();
    }

    public function index() {

        $this->view->render("company/lists/display"); 
    }

}