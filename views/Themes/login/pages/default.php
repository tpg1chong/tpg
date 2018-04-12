<?php

$f = new Form();
$form = $f->create(); 

    // attr, options
$form   ->addClass('login-form-container form-insert form-large')
        ->method('post')
        ->url( $this->redirect );

    // set field
$form   ->field("email")
        ->label('<i class="icon-user"></i>')
        ->placeholder("Username")
        ->addClass('inputtext')
        ->required(true)
        ->autocomplete("off");

if( (!empty($this->post['email']) && !empty($this->error['email'])) || empty($this->post['email']) ){
$form   ->attr('autofocus', '1');
}

$form   ->value( !empty($this->post['email'])? $this->post['email'] : '' )
        ->notify( !empty($this->error['email']) ? $this->error['email'] : '' );

$form   ->field("pass")
        ->label('<i class="icon-key"></i>')
        ->type('password')
        ->required(true);

if( (!empty($this->post['email']) && empty($this->error['email'])) ){
$form   ->attr('autofocus', '1');
}

$form   ->addClass('inputtext')
        ->placeholder("Password")
        ->notify( !empty($this->error['pass']) ? $this->error['pass'] : '' );


if( !empty($this->captcha) ){

    $form->field("captcha")
    ->text('<div class="g-recaptcha" data-sitekey="'.RECAPTCHA_SITE_KEY.'"></div>')
    ->notify( !empty($this->error['captcha']) ? $this->error['captcha'] : '' );

}

$form->hr( !empty($this->next) ? '<input type="hidden" autocomplete="off" value="'.$this->next .'" name="next">': '' )

// ->hr('<input type="hidden" autocomplete="off" value="1" name="path_admin">' )

->submit()
->addClass('btn btn-blue btn-large')
->value('Sign In');


$title = $this->getPage('title');
$name = $this->getPage('name');
$image = $this->getPage('image');

// auth/google_oauth2
/*if( !$auth->isLoggedIn() ){
    echo 1; 
}
else{
    echo 5555;
}*/
// $_SERVER['HTTP_HOST']

?>

<div class="section">
    <div class="content-wrapper<?=!empty($this->captcha)? ' has-captcha':''?>">

        <!-- end: login-header -->

        <div class="login-container-wrapper auth-box">
            <div class="login-container">
                <div class="login-title"><span class="fwb">Sign in to your account</span></div>
                
                <?=$form->html()?>
            </div>

        </div>
        <!-- end: login-container-wrapper -->

        <div class="login-footer-text">
            <!-- <a href="<?=URL?>"><i class="icon-home mrs"></i><span>Back To Home</span></a><span class="mhm">·</span> -->
            <a href="<?=URL?>admin/forgot_password" class="forgot_password"><span>Forgot password?</span></a>
        </div>
        <!-- end: login-footer -->
        
    </div>
    <!-- end: content-wrapper -->

</div>
<!-- /section -->