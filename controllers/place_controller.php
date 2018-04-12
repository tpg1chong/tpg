<?php

class Place_Controller extends Controller {

    public function __construct() {
        parent::__construct();
    }

    public function index() {
        $this->error();
    }

    public function add() {
        if( empty($this->me) || $this->format!='json' ) $this->error();
        
        $facilities = $this->model->query('property')->facilities->find();
        $this->view->setData('facilitiesList', $facilities['items'] );

        $type = $this->model->query('property')->type->find();
        $this->view->setData('typeList', $type['items'] );

        $country = $this->model->query('location')->country->find();
        $this->view->setData('countryList', $country['items'] ); 

        $this->view->setPage('path', 'Themes/admin/forms/place');
        $this->view->render("add");
    }

    public function save()
    {
        if( empty($this->me) || $this->format!='json' || empty($_POST) ) $this->error();

        $arr = array();
        $options = $_POST['options'];
        $dataPost = array();

        if( $options['type']=='location' || !empty($options['save']) ){
            $location = $_POST['location'];
            foreach (array( 'country', 'province', 'zone', 'district', 'road', 'soi', 'number' ) as $key) {

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

        if( $options['type']=='picture' || !empty($options['save']) ){
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

        if(empty($options['save'])){
            $arr['onDialog'] = 1;
        }

        if( !empty($options['save']) && empty($arr['error']) ){

            $dataPost['building_create_date'] = date('c');
            $dataPost['building_create_by'] = $this->me['id'];
            $dataPost['building_update_date'] = date('c');

            $this->model->query('place')->insert( $dataPost );

            if( !empty($photos) && !empty($dataPost['id']) ){
                $sequence = 0;

                foreach ($photos as $key => $value) {
                    $sequence++;
                    $value['album_id'] = $dataPost['id'];
                    $value['sequence'] = $sequence;
                    $this->model->query('place')->photo->set($value);
                }
            }

            if( !empty($dataPost['id']) ){
                $arr['message'] = 'Done.';
                $arr['url'] = URL.'admin/place/'.$dataPost['id'];
            }
            else{
                $arr['message'] = "Can't save data. Please try again.";
            }
        }

        echo json_encode($arr);
    }

    public function del($id=null)
    {
        $id = isset($_REQUEST['id']) ? $_REQUEST['id'] : $id;
        if( empty($this->me) || empty($id) ) $this->error();

        $item = $this->model->findById($id);
        if( empty($item) ) $this->error();

        if (!empty($_POST)) {

            if ( !empty($item['permit']['del']) ) {

                if( !empty($item['images']) ){
                    foreach ($item['images'] as $key => $value) {
                        $this->model->photo->delete($value['id'], $value);
                    }
                }

                $this->model->delete($id);
                $arr['message'] = 'ลบข้อมูลเรียบร้อย';
            } else {
                $arr['message'] = 'ไม่สามารถลบข้อมูลได้';
            }

            $arr['url'] =  !empty($_REQUEST['next']) ? $_REQUEST['next']: 'refresh';
            echo json_encode($arr);
        }
        else{
            $this->view->item = $item;
            
            $this->view->setPage('path','Themes/admin/forms/place');
            $this->view->render("del");
        } 
    }

    public function invite_partner($id=null)
    {

        $id = isset($_REQUEST['id']) ? $_REQUEST['id'] : $id;
        if( empty($this->me) || empty($id) ) $this->error();

        $item = $this->model->findById($id);
        if( empty($item) ) $this->error();

        if( !empty($_POST) ){

            $partner = !empty($_POST['invite']['id'][0]) ? $_POST['invite']['id'][0]: '';


            $this->model->update( $id, array('building_partner_id'=>$partner) );

            $arr['url'] = 'refresh';
            $arr['message'] = 'Saved.';

            echo json_encode($arr);
        }
        else{

            $this->view->item = $item;
            $this->view->setPage('path','Themes/admin/forms/place');
            $this->view->render("invite_partner");
        }
    }
}