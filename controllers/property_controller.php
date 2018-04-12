<?php

class Property_Controller extends Controller {

    public function __construct() {
        parent::__construct();
    }

    public function index() {

        $this->error();
    }

    /* -- Property Action -- */
    public function add( $action='' ) {

        if( empty($this->me) || $this->format!='json' ) $this->error();
        $path = 'Themes/admin/forms/property';
        $path .= !empty( $action ) ? "/{$action}":'';


        if( $action=='facilities' ){

            $category = $this->model->query('property')->facility_types->find();
            $this->view->setData('typesList', $category['items'] );
        }

        if( $action=='room' ){
            $offers = $this->model->query('property')->room_offers->find();
            $this->view->setData('offersList', $offers['items'] );
        }

        if( $action=='room_offer_types' || $action=='room_offers' ){

            $category = $this->model->query('property')->room_category->find();
            $this->view->setData('categoryList', $category['items'] );
        }

        if( $action=='room_offers' ){
            $types = $this->model->query('property')->room_offer_types->find();
            $this->view->setData('typesList', $types['items'] );
        }



        $this->view->setPage('path', $path);
        $this->view->render('add');
    }
    public function edit( $action='property', $id=null )
    {
        if( is_numeric($action) && $id==null ){
            $item = $this->model->get($action);
            $this->view->setData('item', $item);
            $this->add( 'property' );
        }
        else{

            $item = $this->model->{$action}->get($id);
            if( empty($item) ) $this->error();
            $this->view->setData('item', $item);
            $this->add( $action );
        }
    }
    public function save( $action='property' ) {

        if( empty($this->me) || $this->format!='json' || empty($_POST) ) $this->error();

        /* Save: type  */
        if( $action=='type' ) {
            $id = isset($_POST['id']) ? $_POST['id']: null;
            if( !empty($id) ){
                $item = $this->model->type->get($id);
                if( empty($item) ) $this->error();
            }

            try {

                $form = new Form();
                $form   ->post('type_code')
                        ->post('type_name')->val('is_empty');

                $form->submit();
                $postData = $form->fetch();

                /*$has_code = true;
                if( $this->model->is_code( $postData['type_code'] ) && !empty($has_code) ){
                    $arr['error']['type_code'] = 'Code already exist !';
                }*/

                if( empty($arr['error']) ){

                    if( !empty($item) ){
                        $this->model->type->update( $id, $postData );
                    }
                    else{
                        $this->model->type->insert( $postData );
                        $id = $postData['id'];
                    }

                    $arr['message'] = 'Saved!';
                    $arr['url'] = !empty($_REQUEST['next']) ? $_REQUEST['next'] : 'refresh';
                }

            } catch (Exception $e) {
                $arr['error'] = $this->_getError($e->getMessage());
            }
        }
        /* Save: zone  */
        else if( $action=='zone' ) {
            $id = isset($_POST['id']) ? $_POST['id']: null;
            if( !empty($id) ){
                $item = $this->model->zone->get($id);
                if( empty($item) ) $this->error();
            }

            try {
                $form = new Form();
                $form   ->post('zone_code')
                        ->post('zone_name')->val('is_empty');

                $form->submit();
                $postData = $form->fetch();

                if( empty($arr['error']) ){

                    if( !empty($item) ){
                        $this->model->zone->update( $id, $postData );
                    }
                    else{
                        $this->model->zone->insert( $postData );
                        $id = $postData['id'];
                    }

                    $arr['message'] = 'Saved!';
                    $arr['url'] = !empty($_REQUEST['next']) ? $_REQUEST['next'] : 'refresh';
                }

            } catch (Exception $e) {
                $arr['error'] = $this->_getError($e->getMessage());
            }
        }
        /* Save: zone  */
        else if( $action=='category' ) {
            $id = isset($_POST['id']) ? $_POST['id']: null;
            if( !empty($id) ){
                $item = $this->model->{$action}->get($id);
                if( empty($item) ) $this->error();
            }

            try {
                $form = new Form();
                $form   ->post('category_name')->val('is_empty');

                $form->submit();
                $postData = $form->fetch();

                if( empty($arr['error']) ){

                    if( !empty($item) ){
                        $this->model->{$action}->update( $id, $postData );
                    }
                    else{
                        $this->model->{$action}->insert( $postData );
                        $id = $postData['id'];
                    }

                    $arr['message'] = 'Saved!';
                    $arr['url'] = !empty($_REQUEST['next']) ? $_REQUEST['next'] : 'refresh';
                }

            } catch (Exception $e) {
                $arr['error'] = $this->_getError($e->getMessage());
            }
        }
        /* Save: 	facilities  */
        elseif ( $action=='facility_types') {
            $id = isset($_POST['id']) ? $_POST['id']: null;
            if( !empty($id) ){
                $item = $this->model->{$action}->get($id);
                if( empty($item) ) $this->error();
            }

            try {
                $form = new Form();
                $form->post('type_name')->val('is_empty');

                $form->submit();
                $postData = $form->fetch();

                if( empty($arr['error']) ){

                    if( !empty($item) ){
                        $this->model->{$action}->update( $id, $postData );
                    }
                    else{
                        $this->model->{$action}->insert( $postData );
                        $id = $postData['id'];
                    }

                    $arr['message'] = 'Saved!';
                    $arr['url'] = !empty($_REQUEST['next']) ? $_REQUEST['next'] : 'refresh';
                }

            } catch (Exception $e) {
                $arr['error'] = $this->_getError($e->getMessage());
            }

        }
        else if( $action=='facilities' ) {
            $id = isset($_POST['id']) ? $_POST['id']: null;
            if( !empty($id) ){
                $item = $this->model->{$action}->get($id);
                if( empty($item) ) $this->error();
            }

            try {
                $form = new Form();
                $form   ->post('facility_type_id')->val('is_empty')
                        ->post('facility_name')->val('is_empty');

                $form->submit();
                $postData = $form->fetch();

                if( empty($arr['error']) ){

                    if( !empty($item) ){
                        $this->model->{$action}->update( $id, $postData );
                    }
                    else{
                        $this->model->{$action}->insert( $postData );
                        $id = $postData['id'];
                    }

                    $arr['message'] = 'Saved!';
                    $arr['url'] = !empty($_REQUEST['next']) ? $_REQUEST['next'] : 'refresh';
                }

            } catch (Exception $e) {
                $arr['error'] = $this->_getError($e->getMessage());
            }
        }

        /* -- room -- */
        /* Save:    room type  */
        else if( $action=='room' ) {

            $id = isset($_POST['id']) ? $_POST['id']: null;
            if( !empty($id) ){
                $item = $this->model->{$action}->get($id);
                if( empty($item) ) $this->error();
            }

            try {

                
                $form = new Form();
                $form   ->post('property_building_id')->val('is_empty')
                        ->post('property_category_id')->val('is_empty')
                        ->post('property_name')->val('is_empty');

                $form->submit();
                $postData = $form->fetch();
                

                if( $postData['property_category_id']==1 ){
                    $postData['property_room_total'] = !empty($_POST['property_room_total'])? $_POST['property_room_total']: 0;
                    $postData['property_guests'] = !empty($_POST['property_guests'])? $_POST['property_guests']: 0;
                    $postData['property_price'] = !empty($_POST['property_price'])? $_POST['property_price']: 0;
                    $postData['property_living_area_sqm'] = !empty($_POST['property_living_area_sqm'])? $_POST['property_living_area_sqm']: 0;
                    $postData['property_living_area_foot'] = !empty($_POST['property_living_area_foot'])? $_POST['property_living_area_foot']: 0;


                    $group_price = array();
                    for ($i=0; $i < count($_POST['group_price']['min']); $i++) { 

                        $min = $_POST['group_price']['min'][$i];
                        $max = $_POST['group_price']['max'][$i];
                        $price = $_POST['group_price']['price'][$i];
                        
                        if( empty($min) && empty($max) && empty($price) ) continue;

                        $group_price[] = array(
                            'min' => $min,
                            'max' => $max,
                            'price' => $price,
                        );
                    }
                    $postData['property_group_price'] = !empty($group_price)? json_encode($group_price): '';
                }
                elseif( $postData['property_category_id']==2 ){
                    $postData['property_capacity'] = !empty($_POST['property_capacity'])? json_encode($_POST['property_capacity']): 0;
                    $postData['property_group_price'] = !empty($_POST['property_group_price'])? json_encode($_POST['property_group_price']): '';
                    $postData['property_sunlight'] = !empty($_POST['property_sunlight'])? 1: 0;
                }
                

                $postData['property_size'] = !empty($_POST['property_size'])? json_encode($_POST['property_size']): '';
                $postData['property_offers'] = !empty($_POST['property_offers'])? json_encode($_POST['property_offers']): '';

                if( empty($arr['error']) ){

                    if( !empty($item) ){
                        $this->model->{$action}->update( $id, $postData );
                    }
                    else{
                        $postData['property_porter'] = $this->me['id'];
                        $this->model->{$action}->insert( $postData );
                        $id = $postData['id'];
                    }


                    $files = isset($_FILES['photo']) ? $_FILES['photo']: array();
                    if( !empty($files) ){
                        for ($i=0; $i < count($files['name']); $i++) { 
                            
                            $photo = array(
                                'album_id' => $id,
                                'name' => $files['name'][$i],
                                'type' => $files['type'][$i],
                                'error' => $files['error'][$i],
                                'size' => $files['size'][$i],
                                'tmp_name' => $files['tmp_name'][$i],
                                'caption' => isset($_POST['caption'][$i]) ? $_POST['caption'][$i]: '',
                                'id' => isset($_POST['photo_id'][$i]) ? $_POST['photo_id'][$i]: '',
                                'sequence' => $i,
                            );

                            $this->model->query('property')->photo->set($photo);
                        }
                    }


                    $arr['message'] = 'Saved!';
                    $arr['url'] = !empty($_REQUEST['next']) ? $_REQUEST['next']: 'refresh';
                }

            } catch (Exception $e) {
                $arr['error'] = $this->_getError($e->getMessage());
            }
        }
        else if( $action=='room_category' ) {
            $id = isset($_POST['id']) ? $_POST['id']: null;
            if( !empty($id) ){
                $item = $this->model->{$action}->get($id);
                if( empty($item) ) $this->error();
            }

            try {
                $form = new Form();
                $form->post('category_name')->val('is_empty');

                $form->submit();
                $postData = $form->fetch();

                if( empty($arr['error']) ){

                    if( !empty($item) ){
                        $this->model->{$action}->update( $id, $postData );
                    }
                    else{
                        $this->model->{$action}->insert( $postData );
                        $id = $postData['id'];
                    }

                    $arr['message'] = 'Saved!';
                    $arr['url'] = !empty($_REQUEST['next']) ? $_REQUEST['next'] : 'refresh';
                }

            } catch (Exception $e) {
                $arr['error'] = $this->_getError($e->getMessage());
            }
        }
        else if( $action=='room_offer_types' ){
            $id = isset($_POST['id']) ? $_POST['id']: null;
            if( !empty($id) ){
                $item = $this->model->{$action}->get($id);
                if( empty($item) ) $this->error();
            }

            try {
                $form = new Form();
                $form   ->post('type_category_id')->val('is_empty')
                        ->post('type_name')->val('is_empty');

                $form->submit();
                $postData = $form->fetch();

                if( empty($arr['error']) ){

                    if( !empty($item) ){
                        $this->model->{$action}->update( $id, $postData );
                    }
                    else{
                        $this->model->{$action}->insert( $postData );
                        $id = $postData['id'];
                    }

                    $arr['message'] = 'Saved!';
                    $arr['url'] = !empty($_REQUEST['next']) ? $_REQUEST['next'] : 'refresh';
                }

            } catch (Exception $e) {
                $arr['error'] = $this->_getError($e->getMessage());
            }
        }
        else if( $action=='room_type' ) {
            $id = isset($_POST['id']) ? $_POST['id']: null;
            if( !empty($id) ){
                $item = $this->model->{$action}->get($id);
                if( empty($item) ) $this->error();
            }

            try {
                $form = new Form();
                $form->post('type_name')->val('is_empty');

                $form->submit();
                $postData = $form->fetch();

                if( empty($arr['error']) ){

                    if( !empty($item) ){
                        $this->model->{$action}->update( $id, $postData );
                    }
                    else{
                        $this->model->{$action}->insert( $postData );
                        $id = $postData['id'];
                    }

                    $arr['message'] = 'Saved!';
                    $arr['url'] = !empty($_REQUEST['next']) ? $_REQUEST['next'] : 'refresh';
                }

            } catch (Exception $e) {
                $arr['error'] = $this->_getError($e->getMessage());
            }
        }
        /* Save: 	amenities  */
        else if( $action=='amenities' ) {
            $id = isset($_POST['id']) ? $_POST['id']: null;
            if( !empty($id) ){
                $item = $this->model->amenities->get($id);
                if( empty($item) ) $this->error();
            }

            try {
                $form = new Form();
                $form->post('amenitie_name')->val('is_empty');

                $form->submit();
                $postData = $form->fetch();

                if( empty($arr['error']) ){

                    if( !empty($item) ){
                        $this->model->amenities->update( $id, $postData );
                    }
                    else{
                        $this->model->amenities->insert( $postData );
                        $id = $postData['id'];
                    }

                    $arr['message'] = 'Saved!';
                    $arr['url'] = !empty($_REQUEST['next']) ? $_REQUEST['next'] : 'refresh';
                }

            } catch (Exception $e) {
                $arr['error'] = $this->_getError($e->getMessage());
            }
        }
        /* Save: 	offers  */
        else if( $action=='room_offers' ) {
            $id = isset($_POST['id']) ? $_POST['id']: null;
            if( !empty($id) ){
                $item = $this->model->{$action}->get($id);
                if( empty($item) ) $this->error();
            }

            try {
                $form = new Form();
                $form   ->post('offer_category_id')->val('is_empty')
                        ->post('offer_type_id')->val('is_empty')
                        ->post('offer_name')->val('is_empty');

                $form->submit();
                $postData = $form->fetch();

                if( empty($arr['error']) ){

                    if( !empty($item) ){
                        $this->model->{$action}->update( $id, $postData );
                    }
                    else{
                        $this->model->{$action}->insert( $postData );
                        $id = $postData['id'];
                    }

                    $arr['message'] = 'Saved!';
                    $arr['url'] = !empty($_REQUEST['next']) ? $_REQUEST['next'] : 'refresh';
                }

            } catch (Exception $e) {
                $arr['error'] = $this->_getError($e->getMessage());
            }
        }
        /* Save: 	payment  */
        else if( $action=='payment_options' ) {
            $id = isset($_POST['id']) ? $_POST['id']: null;
            if( !empty($id) ){
                $item = $this->model->{$action}->get($id);
                if( empty($item) ) $this->error();
            }

            try {
                $form = new Form();
                $form->post('payment_name')->val('is_empty');

                $form->submit();
                $postData = $form->fetch();

                if( empty($arr['error']) ){

                    if( !empty($item) ){
                        $this->model->{$action}->update( $id, $postData );
                    }
                    else{
                        $this->model->{$action}->insert( $postData );
                        $id = $postData['id'];
                    }

                    $arr['message'] = 'Saved!';
                    $arr['url'] = !empty($_REQUEST['next']) ? $_REQUEST['next'] : 'refresh';
                }

            } catch (Exception $e) {
                $arr['error'] = $this->_getError($e->getMessage());
            }
        }
        /* Save: 	transportation  */
        else if( $action=='transportation' ) {
            $id = isset($_POST['id']) ? $_POST['id']: null;
            if( !empty($id) ){
                $item = $this->model->transportation->get($id);
                if( empty($item) ) $this->error();
            }

            try {
                $form = new Form();
                $form->post('transport_name')->val('is_empty');

                $form->submit();
                $postData = $form->fetch();

                if( empty($arr['error']) ){

                    if( !empty($item) ){
                        $this->model->transportation->update( $id, $postData );
                    }
                    else{
                        $this->model->transportation->insert( $postData );
                        $id = $postData['id'];
                    }

                    $arr['message'] = 'Saved!';
                    $arr['url'] = !empty($_REQUEST['next']) ? $_REQUEST['next'] : 'refresh';
                }

            } catch (Exception $e) {
                $arr['error'] = $this->_getError($e->getMessage());
            }
        }


        // Location
        /* Save: 	region  */
        else if( $action=='region' ) {
            $id = isset($_POST['id']) ? $_POST['id']: null;
            if( !empty($id) ){
                $item = $this->model->region->get($id);
                if( empty($item) ) $this->error();
            }

            try {
                $form = new Form();
                $form->post('region_name')->val('is_empty');

                $form->submit();
                $postData = $form->fetch();

                if( empty($arr['error']) ){

                    if( !empty($item) ){
                        $this->model->region->update( $id, $postData );
                    }
                    else{
                        $this->model->region->insert( $postData );
                        $id = $postData['id'];
                    }

                    $arr['message'] = 'Saved!';
                    $arr['url'] = !empty($_REQUEST['next']) ? $_REQUEST['next'] : 'refresh';
                }

            } catch (Exception $e) {
                $arr['error'] = $this->_getError($e->getMessage());
            }
        }

        /* Save: 	country  */
        else if( $action=='country' ) {
            $id = isset($_POST['id']) ? $_POST['id']: null;
            if( !empty($id) ){
                $item = $this->model->country->get($id);
                if( empty($item) ) $this->error();
            }

            try {
                $form = new Form();
                $form->post('country_name')->val('is_empty');

                $form->submit();
                $postData = $form->fetch();

                if( empty($arr['error']) ){

                    if( !empty($item) ){
                        $this->model->country->update( $id, $postData );
                    }
                    else{
                        $this->model->country->insert( $postData );
                        $id = $postData['id'];
                    }

                    $arr['message'] = 'Saved!';
                    $arr['url'] = !empty($_REQUEST['next']) ? $_REQUEST['next'] : 'refresh';
                }

            } catch (Exception $e) {
                $arr['error'] = $this->_getError($e->getMessage());
            }
        }
        /* Save: 	geography  */
        else if( $action=='geography' ) {
            $id = isset($_POST['id']) ? $_POST['id']: null;
            if( !empty($id) ){
                $item = $this->model->geography->get($id);
                if( empty($item) ) $this->error();
            }

            try {
                $form = new Form();
                $form->post('geo_name')->val('is_empty');

                $form->submit();
                $postData = $form->fetch();

                if( empty($arr['error']) ){

                    if( !empty($item) ){
                        $this->model->geography->update( $id, $postData );
                    }
                    else{
                        $this->model->geography->insert( $postData );
                        $id = $postData['id'];
                    }

                    $arr['message'] = 'Saved!';
                    $arr['url'] = !empty($_REQUEST['next']) ? $_REQUEST['next'] : 'refresh';
                }

            } catch (Exception $e) {
                $arr['error'] = $this->_getError($e->getMessage());
            }
        }

        /* Save: Property  */
        else if( $action=='property' ){

        }
        else{
            $arr['error'] = 400;
        }


        echo json_encode($arr);
    }
    public function del( $action='property', $id=null ) {

        $id = isset($_REQUEST['id']) ? $_REQUEST['id']: $id;
        $path = 'Themes/admin/forms/property';
        if( is_numeric($action) && $id==null ){
            $item = $this->model->get($action);
        }
        else{
            $path .= "/{$action}";
            $item = $this->model->{$action}->get($id);
        }

        if( empty($item) ) $this->error();

        if( !empty($_POST) ){

            if( !empty($item['permit']['del']) ){

                if( $action=='property' ){
                    $this->model->{$action}->delete( $id );
                }
                else{
                    $this->model->{$action}->delete( $id );
                }

                $arr['message'] = 'Deleted!';
                $arr['url'] = 'refresh';
            }
            else{
                $arr['error'] = 1;
                $arr['message'] = "Can't Delete";
            }

            echo json_encode( $arr );
        }
        else{
            $this->view->setData('item', $item);
            $this->view->setPage('path', $path );
            $this->view->render('del');
        }
    }



}
