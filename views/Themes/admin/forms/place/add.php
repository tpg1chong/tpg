<?php


$fristStep = 'location';

$step = array();
$step[] = array('text'=>'Basic Info', 'name'=>'basic');
$step[] = array('text'=>'Location', 'name'=>'location');
$step[] = array('text'=>'Facilities', 'name'=>'detail');
$step[] = array('text'=>'Picture', 'name'=>'picture');

$body = '<div class="form-places-create-step clearfix" data-ref="step">';
$body .= $this->fn->stepList($step, $fristStep);
$body .='</div>';


$body .= '<input id="options_type" type="hidden" name="options[type]" value="'.$fristStep.'">';
$body .= '<input id="options_save" type="hidden" name="options[save]">';


$body .='<div class="form-places">';
foreach ($step as $key => $value) {

/*$path = __DIR__. "/create/{$value['name']}.php";
if( file_exists($path) ){*/

    $active = $fristStep==$value['name'] ? ' active':'';
    $body .='<div class="form-places-section clearfix'.$active.'" data-section="'.$value['name'].'">';
    include_once "steps/{$value['name']}.php";
    $body .='</div>';
// }
}

$body .='</div>';


# set form
$arr['form'] = '<form data-plugins="formPlacesCreate" class="form-places-create" method="post" action="'.URL. 'place/save"></form>';

# body
$arr['body'] = $body;

# title
$arr['title']= 'Create place';


// <button data-action="prev" type="button" class="btn">Back</button>

# fotter: button
$arr['button'] = '<button data-action="submit" type="submit" class="btn btn-primary btn-submit"><span class="text-submit-next">Next</span><span class="text-submit-save">Save</span></button>';
$arr['bottom_msg'] = '<button type="button" class="btn" data-action="prev"><span class="btn-text">'.Translate::val('Back').'</span></a>';

$arr['width'] = 960;

// data-action="close" 

echo json_encode($arr);