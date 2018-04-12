<?php

?>

<div class="section">
    <div class="content-wrapper<?=!empty($this->captcha)? ' has-captcha':''?>">

        <div class="login-header-bar login-logo">
            <div class="text">
                <?php if( !empty($image) ){ ?><div class="pic"><img src="<?=$image?>"></div><?php } ?>
                <h2><?= !empty( $title ) ? $title :''?></h2>
            </div>

            <div class="subtext mvm"></div>
        </div>
        <!-- end: login-header -->

        <div class="login-container-wrapper auth-box">
            <div class="login-container">
                <div class="login-title"><span class="fwb">Why can't you sign in?</span></div>
                
                <ul>
                    <li><label class="radio"><input type="radio" name="whyResetRadio" value="0"><span>I forgot my password</span></label></li>
                    <li><label class="radio"><input type="radio" name="whyResetRadio" value="0"><span>I know my password, but can't sign in</span></label></li>
                    <li><label class="radio"><input type="radio" name="whyResetRadio" value="0"><span>I think someone else is using</span></label></li>
                </ul>

                <div class="mtl">
                    <a href="<?=URL?>admin/" class="btn">Cancel</a>
                    <button type="button" class="btn btn-blue">Next</button>
                </div>
            </div>

        </div>
        <!-- end: login-container-wrapper -->
        
    </div>
    <!-- end: content-wrapper -->

</div>
<!-- /section -->