<?php

class Partner_Controller extends Controller {

    public function __construct() {
        parent::__construct();
    }

    public function index() {
        $this->error();
    }

    public function add() {
        if( empty($this->me) || $this->format!='json' ) $this->error();

        $this->view->setPage('path', 'Themes/admin/forms/partner');
        $this->view->render("add");
    }

    public function edit($id=null) {

        $id = isset($_REQUEST['id']) ? $_REQUEST['id']: $id;
        if( empty($this->me) || empty($id) || $this->format!='json' ) $this->error();

        $item = $this->model->findById($id);
        if( empty($item) ) $this->error();

        if (!empty($_POST)) {

            try {
                $form = new Form();
                $form   ->post('partner_name')->val('is_empty')
                        ->post('partner_username')->val('username')
                        ->post('partner_email')->val('email')
                        ->post('partner_phone');

                $form->submit();
                $postData = $form->fetch();

                if( $item['username']!=$postData['partner_username'] && $this->model->is_user( $postData['partner_username'] ) ){
                    $arr['error']['partner_username'] = 'ไม่สามารถใช้ชื่อผู้ใช้นี้ได้';
                }

                if( empty($arr['error']) ){

                    $this->model->update( $id, $postData );
                    $postData['id'] = $id;
                    
                    $arr['message'] = 'Saved.';
                    $arr['url'] = 'refresh';
                }

            } catch (Exception $e) {
                $arr['error'] = $this->_getError($e->getMessage());
            }

            echo json_encode($arr);
        }
        else{
            $this->view->setData('item', $item );
            $this->view->setPage('path', 'Themes/admin/forms/partner');
            $this->view->render("edit");
        }        
    }

    public function save() {
        if( empty($_POST) || empty($this->me) || $this->format!='json' ) $this->error();
        
        $id = isset($_POST['id']) ? $_POST['id']: null;

        if( !empty($id) ){
        	$item = $this->model->findById($id);
        	if( empty($item) ) $this->error();
        }

        try {
            $form = new Form();
            $form   ->post('partner_name')->val('is_empty')
                    ->post('partner_username')->val('username')
                    ->post('partner_email')->val('email')
                    ->post('partner_phone');

            $form->submit();
            $postData = $form->fetch();


            $lenPass = 8;
            if( isset($_POST['auto_password']) ){
                $arr['password'] = $this->fn->q('user')->generateStrongPassword($lenPass);
            }
            else if(strlen($_POST['password']) < $lenPass ){
                $arr['error']['password'] = "รหัสผ่านต้องมากกว่า {$lenPass} ตัว";
            }
            else{
                $arr['password'] = $_POST['password'];
            }


            if( $this->model->is_user( $postData['partner_username'] ) ){
                $arr['error']['partner_username'] = 'ไม่สามารถใช้ชื่อผู้ใช้นี้ได้';
            }

            if( empty($arr['error']) ){

                $postData['partner_password'] = $arr['password'];
                $this->model->insert( $postData );
                $postData['id'] = $id;
                
                $arr['data'] = array(
                    'name' => $postData['name'],
                    'login' => $postData['username'],
                );
                $arr['message'] = 'Saved.';
                // $arr['url'] = 'refresh';
            }

        } catch (Exception $e) {
            $arr['error'] = $this->_getError($e->getMessage());
        }

        echo json_encode($arr);
    }

    public function del($id=null) {
        $id = isset($_REQUEST['id']) ? $_REQUEST['id'] : $id;
        if( empty($this->me) || empty($id) ) $this->error();

        $item = $this->model->findById($id);
        if( empty($item) ) $this->error();

        if (!empty($_POST)) {

            if ( !empty($item['permit']['del']) ) {
                $this->model->delete($id);
                $arr['message'] = 'ลบข้อมูลเรียบร้อย';
            } else {
                $arr['message'] = 'ไม่สามารถลบข้อมูลได้';
            }

            $arr['url'] = 'refresh';
            echo json_encode($arr);
        }
        else{
            $this->view->item = $item;
            
            $this->view->setPage('path','Themes/admin/forms/partner');
            $this->view->render("del");
        } 
    }
    public function change_password($id='') {
        $id = isset($_REQUEST['id']) ? $_REQUEST['id']: $id;
        if( empty($this->me) || empty($id) || $this->format!='json' ) $this->error();

        $item = $this->model->findById($id);
        if( empty($item) ) $this->error();

        if( !empty($_POST) ){
            
            $leg = 8;
            if( !empty( $_POST['password_auto'] ) ){
                $arr['password'] = $this->fn->q('user')->generateStrongPassword( $leg );
            }
            else{

                if( strlen($_POST['password_new']) < $leg ){
                    $arr['error']['password_new'] = "รหัสผ่านต้องมากกว่า {$leg} ตัว";
                }
                else if( $_POST['password_new']!=$_POST['password_confirm'] ){
                    $arr['error']['password_confirm'] = 'รหัสผ่านไม่ตรงกัน';
                }
                else{
                    $arr['password'] = $_POST['password_new'];
                }
            }

            if( empty($arr['error']) ){

                // update
                $this->model->update($item['id'], array(
                    'partner_password' => Hash::create('sha256', $arr['password'], HASH_PASSWORD_KEY )
                ));

                $arr['message'] = "Saved.";
            }            

            echo json_encode($arr);
        }
        else{
            $this->view->setData('item', $item );
            
            $this->view->setPage('path','Themes/admin/forms/partner');
            $this->view->render("change_password");
        }
    }
    public function update($id=null) {
        $id = isset($_REQUEST['id']) ? $_REQUEST['id']: $id;
        if( empty($this->me) || $this->format!='json' || empty($id) ) $this->error();

        $item = $this->model->findById($id);
        if( empty($item) ) $this->error();

        $name = isset($_REQUEST['name']) ? $_REQUEST['name']: '';
        $value = isset($_REQUEST['value']) ? $_REQUEST['value']: '';

        $dataPost = array();
        $dataPost[ $name ] = trim($value);

        $this->model->update($id, $dataPost);

        echo json_encode(array('message'=>'Saved.'));
    }


    public function invite() {
        
        if( empty($this->me )|| $this->format!='json' ) $this->error();
        $data = $this->model->find( array('view_stype'=>'bucketed', 'limit'=>20, 'status'=>'run', 
            'sort'=>'updated') );

        $results = array();
        $results[] = array(
            'object_type'=>'partner', 
            'object_name'=>'Partner',
            'data' => $data
        );

        echo json_encode($results); die;
    }
}