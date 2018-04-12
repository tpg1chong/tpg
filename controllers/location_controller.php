<?php

class Location_Controller extends Controller {

    public function __construct() {
        parent::__construct();
    }

    public function index() {

        $this->error();
    }


    /* -- Location Action -- */
    public function add( $action='' ) {

        if( empty($this->me) || $this->format!='json' ) $this->error();
        $path = 'Themes/admin/forms/location';
        $path .= !empty( $action ) ? "/{$action}":'';

        if( !empty($action=='province') || !empty($action=='zone')  ){

            $country = $this->model->query('location')->country->find();
            $this->view->setData('countryList',  $country['items']);
        }


        if( !empty($action=='zone') ){

            $province = $this->model->query('location')->province->find();
            $this->view->setData('provinceList',  $province['items']);
        }

        

        $this->view->setPage('path', $path);
        $this->view->render('add');
    }
    public function edit( $action='location', $id=null )
    {
        if( is_numeric($action) && $id==null ){
            $item = $this->model->get($action);
            $this->view->setData('item', $item);
            $this->add( 'location' );
        }
        else{

            if( $action=='zone' ){

                $results = $this->model->country->find();
                $this->view->setData('countryList', $results['items'] );

                $results = $this->model->province->find();
                $this->view->setData('provinceList', $results['items'] );
            }

            $item = $this->model->{$action}->get($id);
            if( empty($item) ) $this->error();
            $this->view->setData('item', $item);
            $this->add( $action );
        }
    }
    public function save( $action='location' ) {

        if( empty($this->me) || $this->format!='json' || empty($_POST) ) $this->error();


        // Location
        if( $action=='places' ) {
            
            $arr = array();
            $options = $_POST['options'];
            $dataPost = array();

            if( $options['type']=='location' || !empty($options['save']) ){
                $location = $_POST['location'];
                foreach (array( 'country', 'province', 'zone', 'district', 'address' ) as $key) {

                    $dataPost[ 'location_'.$key ] = trim($location[$key]);
                    
                    if( empty( $location[$key] ) ){
                        $arr['error']['location_'.$key] = 'Please input data.';
                    }
                }
            }

            if( $options['type']=='basic' || !empty($options['save']) ){

                $building = $_POST['building'];
                foreach (array( 'type', 'name', 'description' ) as $key) {

                    $dataPost[ 'building_'.$key ] = trim($building[$key]);
                    
                    if( empty( $building[$key] ) ){
                        $arr['error']['building_'.$key] = 'Please input data.';
                    }
                }
            }

            if( $options['type']=='detail' || !empty($options['save'])){
                
                
                if( !empty($_POST['facilities']) ){
                    $dataPost['building_facilities'] = json_encode($_POST['facilities']);
                }
            }


            if( $options['type']=='picture' ){
                $files = isset($_FILES['photo']) ? $_FILES['photo']: array();
                $photos = array();

                if( !empty($files) ){
                    for ($i=0; $i < count($files['name']); $i++) { 
                        
                        $photos[] = array(
                            'name' => $files['name'][$i],
                            'type' => $files['type'][$i],
                            'error' => $files['error'][$i],
                            'size' => $files['size'][$i],
                            'tmp_name' => $files['tmp_name'][$i],
                            'caption' => isset($_POST['caption'][$i]) ? $_POST['caption'][$i]: '',
                            'id' => isset($_POST['photo_id'][$i]) ? $_POST['photo_id'][$i]: '',  
                        );

                    }
                }
            }


            if( !empty($options['save']) && empty($arr['error']) ){

                $dataPost['building_create_date'] = date('c');
                $dataPost['building_create_by'] = $this->me['id'];
                $dataPost['building_update_date'] = date('c');

                $this->model->query('place')->insert( $dataPost );

                if( !empty($photos) ){
                    foreach ($photos as $key => $value) {
                        // $this->model->query('place')->photo->insert($value);
                    }
                }

                $arr['url'] = URL.'admin/place';
            }

            // $arr['message'] = '+55555';
        }

        /* Save: region  */
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
        /* Save: country  */
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
        /* Save: geography  */
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
        /* Save: city  */
        else if( $action=='city' ) {
            $id = isset($_POST['id']) ? $_POST['id']: null;
            if( !empty($id) ){
                $item = $this->model->city->get($id);
                if( empty($item) ) $this->error();
            }

            try {
                $form = new Form();
                $form->post('city_name')->val('is_empty');

                $form->submit();
                $postData = $form->fetch();

                if( empty($arr['error']) ){

                    if( !empty($item) ){
                        $this->model->city->update( $id, $postData );
                    }
                    else{
                        $this->model->city->insert( $postData );
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
        else if( $action=='province' ) {
            $id = isset($_POST['id']) ? $_POST['id']: null;
            if( !empty($id) ){
                $item = $this->model->{$action}->get($id);
                if( empty($item) ) $this->error();
            }

            try {
                $form = new Form();
                $form   ->post('province_country_id')->val('is_empty')
                        ->post('province_name')->val('is_empty');

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
        /* Save: zone  */
        else if( $action=='zone' ) {
            $id = isset($_POST['id']) ? $_POST['id']: null;
            if( !empty($id) ){
                $item = $this->model->{$action}->get($id);
                if( empty($item) ) $this->error();
            }

            try {
                $form = new Form();
                $form->post('zone_name')->val('is_empty');

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

        /*Save: Location  */
        else if( $action=='location' ){

        }
        else{
            $arr['error'] = 400;
        }


        echo json_encode($arr);
    }
    public function del( $action='location', $id=null ) {

        $id = isset($_REQUEST['id']) ? $_REQUEST['id']: $id;
        $path = 'Themes/admin/forms/location';
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

                if( $action=='location' ){
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
    public function update( $action='', $id=null )
    {
        $id = isset($_REQUEST['id']) ? $_REQUEST['id']: $id;
        

        if( empty($this->me) || $this->format!='json' || empty($id) ) $this->error();


        $name = isset($_REQUEST['name']) ? $_REQUEST['name']: '';
        $value = isset($_REQUEST['value']) ? $_REQUEST['value']: '';

        $dataPost = array();
        $dataPost[ $name ] = trim($value);


        if( is_numeric($action) && $id==null ){

        }else{
            $item = $this->model->{$action}->findById($id);
            if( empty($item) ) $this->error();

            $this->model->{$action}->update($id, $dataPost);
        }

        echo json_encode(array('message'=>'Saved.'));  
    }

    /* -- Fide Data -- */
    public function placesList() {
        $this->view->setData('results', $this->model->places->find());
        $this->view->setPage('path', 'Themes/admin/layouts/places/items/');
        $this->view->render('json');
    }

    public function provinceList()
    {
        $results = $this->model->query('location')->province->find();

        if( isset($_REQUEST['has_item']) ){

            $country = $this->model->query('location')->country->find();
            $this->view->setData('countryList',  $country['items']);
            
            $this->view->setData('results', $results );
            $this->view->setPage('path', 'Themes/admin/layouts/location/province/items/');
            $this->view->render('json');
        }
        else{
            echo json_encode( $results['items'] );
        }
    }
    public function zoneList()
    {
        $results = $this->model->query('location')->zone->find();
        
        if( isset($_REQUEST['has_item']) ){
            $this->view->setData('results', $results );
            $this->view->setPage('path', 'Themes/admin/layouts/location/zone/items/');
            $this->view->render('json');
        }
        else{
            echo json_encode( $results['items'] );
        }
        
    }
    public function districtList()
    {
        $results = $this->model->query('location')->district->find();

        if( isset($_REQUEST['has_item']) ){
            $this->view->setData('results', $results );
            $this->view->setPage('path', 'Themes/admin/layouts/location/district/items/');
            $this->view->render('json');
        }
        else{
            echo json_encode( $results['items'] );
        }
    }
}
