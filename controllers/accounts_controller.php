<?php

class Accounts_Controller extends Controller {

    function __construct() {
        parent::__construct();
    }

    public function index(){
        $this->error();
    }

    public function logout()
    {
        if( empty($this->me) || empty($_POST) ){
            $this->error();
        }


        Session::init();
        Session::destroy();

        $redirect = !empty($_REQUEST['next']) ? $_REQUEST['next']: URL;
        Cookie::clear( COOKIE_KEY_USER );
        
        header('location:' . $redirect);
    }
}