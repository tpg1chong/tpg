<?php

class Customers extends Controller {

    public function __construct() {
        parent::__construct();
    }

    public function index( $id=null, $section='services' ) {
    	$this->view->setPage('on', 'customers' );
           
        if( !empty($id) ){

            $options = array();

            $options['options'] = 1;

            $item = $this->model->query('customers')->get( $id, $options );
            if( empty($item) ) $this->error();

            $this->view->setData('id', $id );
            $this->view->setData('item', $item );
            $this->view->setData('tab', $section); 
            $this->view->render("customers/profile/display");
        }
        else{

            Session::init();
            
            if( $this->format=='json' )  {

                Session::set('customers_settings', array(
                    'company' => isset($_REQUEST['company']) ? $_REQUEST['company']:''
                ));


                $this->view->setData('results', $this->model->query('customers')->lists() );
                $render = "customers/lists/json";
            }
            else{

                $settings = Session::get('customers_settings');
                $this->view->setData('settings', !empty($settings) ? $settings:array() );
                $this->view->setData('status', $this->model->query('customers')->status() );
                $render = "customers/lists/display";
            }

            $this->view->render($render);
        }
    }
    public function add() {
    	if( empty($this->me) || $this->format!='json'  ) $this->error();

        $this->view->setData('prefixName', $this->model->query('system')->prefixName());
        $this->view->setData('status', $this->model->query('customers')->status() );
        $this->view->setData('companies', $this->model->query('customers')->company() );

        $this->view->setPage('path','Forms/customers');
        $this->view->render("add");
    }
    public function edit( $id=null ){
        $id = isset($_REQUEST['id']) ? $_REQUEST['id']: $id;
        if( empty($this->me) || empty($id) || $this->format!='json' ) $this->error();

        $item = $this->model->get( $id, array('options'=>true) );
        if( empty($item) ) $this->error();

        $this->view->setData('item', $item );
        
        $this->view->setData('prefixName', $this->model->query('system')->prefixName());
        $this->view->setData('status', $this->model->query('customers')->status() );
        $this->view->setData('companies', $this->model->query('customers')->company() );

        $this->view->setPage('path','Forms/customers');
        $this->view->render("add");
    }
    public function save() {
    	if( empty($this->me) ||empty($_POST) ) $this->error();

        $id = isset($_POST['id']) ? $_POST['id']: null;
        if( !empty($id) ){
            $item = $this->model->get($id, array('options'=> true));
            if( empty($item) ) $this->error();
        }

        try {
            $form = new Form();
            $form   ->post('cus_prefix_name')
                    ->post('cus_first_name')->val('is_empty')
                    ->post('cus_last_name')
                    ->post('cus_nickname');

            $form->submit();
            $postData = $form->fetch();

            $postData['cus_birthday'] = !empty($birthday) ? $birthday : '0000-00-00';
            $postData['cus_first_name'] = trim($postData['cus_first_name']);
            $postData['cus_last_name'] = trim($postData['cus_last_name']);

            /*$has_name = true;
            if( !empty($item) ){
                if( $postData['cus_first_name']==$item['first_name'] && $postData['cus_last_name']==$item['last_name'] ){
                    $has_name = false;
                }
            }

            /*if( $this->model->is_name( $postData['cus_first_name'], $postData['cus_last_name'] ) && $has_name == true ){
                $arr['error']['cus_name'] = 'Name already have';
            }*/

            // set options
            $options = array();
            if( !empty($_POST['options']) ){
                foreach ($_POST['options'] as $type => $values) {
                    foreach ($values['name'] as $key => $value) {

                        if( empty($values['value'][$key]) ) continue;

                        $options[$type][] = array(
                            'type' => $type,
                            'label' => trim($value), 
                            'value' => trim($values['value'][$key])
                        );
                    }
                }

                $postData['cus_email'] = !empty($options['email'][0]['value'])
                    ? $options['email'][0]['value']
                    : '';

                $postData['cus_phone'] = !empty($options['phone'][0]['value'])
                    ? $options['phone'][0]['value']
                    : '';

                $postData['cus_lineID'] = !empty($options['social'][0]['value'])
                    ? $options['social'][0]['value']
                    : '';
            }

            #company
            if( empty($_REQUEST['cus_company_id']) ){
                $arr['error']['cus_company_id'] = 'Input Company';
            }
            else{

                $company_type = isset($_REQUEST['cus_company_id_type']) ? $_REQUEST['cus_company_id_type'] : '';
                
                if( $company_type=='id' ){
                    $postData['cus_company_id'] = $_REQUEST['cus_company_id'];
                }
                else{

                    $new_company = array(
                        'company_name' => $_REQUEST['cus_company_id'],
                    );
                }
            }

    
            if( empty($arr['error']) ){

                if( isset($_REQUEST['status']) ){
                    $postData['cus_status'] = $_REQUEST['status'];
                }

                if( isset($new_company) ){
                    $this->model->query('companies')->insert($new_company);
                    $postData['cus_company_id'] = $new_company['id'];
                }

                if( !empty($item) ){
                    $this->model->update( $id, $postData );
                }
                else{

                    $postData['cus_emp_id'] = $this->me['id'];

                    $this->model->insert( $postData );
                    $id = $postData['id'];

                    $arr['url'] = URL.'customers/'.$id;
                }

                if( !empty($options) ){
                    if( !empty($item['options']) ){

                        $_options = array();
                        foreach ($item['options'] as $types => $values) {
                            foreach ($values as $key => $value) {
                                $value['type'] = $types;
                                $_options[] = $value;
                            } 
                        }
                    }

                    $c=0;
                    foreach ($options as $key => $values) {
                        foreach ($values as $data) {

                            if( !empty($_options[$c]['id']) ){
                                $data['id'] = $_options[$c]['id'];
                                unset($_options[$c]);
                            }

                            $data['cus_id'] = $id;
                            $this->model->set_option( $data );
                            $c++;     
                        }
                    }

                    if( !empty($_options) ){
                        foreach ($_options as $key => $value) {
                            $this->model->del_option( $value['id'] );
                        }
                    }
                }

                $arr['message'] = 'บันทึกเรียบร้อย';
                $arr['url'] = 'refresh';

                if( isset( $_REQUEST['callback'] ) ){
                    $item = !empty($item) ? $item: array();
                    $postData['options'] = $options;
                    $arr['data'] = array_merge($item, $this->model->convert($postData) );
                }
            }

        } catch (Exception $e) {
            $arr['error'] = $this->_getError($e->getMessage());

            if( !empty($arr['error']['cus_prefix_name']) ){
                $arr['error']['cus_nickname'] = $arr['error']['cus_prefix_name'];
                unset($arr['error']['cus_prefix_name']);
            } else if( !empty($arr['error']['cus_first_name']) ){
                $arr['error']['cus_nickname'] = 'Please input First name.';
                unset($arr['error']['cus_first_name']);
            } else if( !empty($arr['error']['cus_last_name']) ){
                $arr['error']['cus_nickname'] = $arr['error']['cus_last_name'];
                unset($arr['error']['cus_last_name']);
            }
        }

        echo json_encode($arr);
    }
    public function del($id=null){
        $id = isset($_REQUEST['id']) ? $_REQUEST['id'] : $id;
        if( empty($this->me) || empty($id) || $this->format!='json' ) $this->error();
        
        $item = $this->model->get($id);
        if( empty($item) ) $this->error();

        if (!empty($_POST)) {

            if ($item['permit']['del']) {
                $this->model->delete($id);
                $arr['message'] = 'Already Removed.';
            } else {
                $arr['message'] = 'Data can not deleted.';
            }

            if( isset($_REQUEST['callback']) ){
                // $arr['callback'] = $_REQUEST['callback'];
                $arr['data'] = $id;
            }
            
            $arr['url'] = isset($_REQUEST['next'])? $_REQUEST['next'] : URL.'customers/';
            
            echo json_encode($arr);
        }
        else{
            $this->view->setData('item', $item);
            $this->view->setPage('path','Forms/customers');
            $this->view->render("del");
        }
    }
    public function dels($ids=null){
        $ids = isset($_REQUEST['ids']) ? $_REQUEST['ids']: $ids;
        if( empty($this->me) || empty($ids) || $this->format!='json' ) $this->error();

        if (!empty($_POST)) {

            foreach ($ids as $id) {                
                $this->model->delete($id);
            }

            $arr['message'] = 'Already Removed.';

            if( isset($_REQUEST['callback']) ){

                $arr['data'] = $ids;
                // $arr['callback'] = $_REQUEST['callback'];
            }
            
            $arr['url'] = isset($_REQUEST['next'])? $_REQUEST['next'] : URL.'customers/';
            echo json_encode($arr);
        }
        else{

            $this->view->setData('ids', $ids);           
            $this->view->setPage('path','Forms/customers');
            $this->view->render("dels");
        }
    }

    /**/
    /* bookmark */
    /**/
    public function bookmark($id=null){
        $id = isset($_REQUEST['id']) ? $_REQUEST['id'] : $id;
        if( empty($this->me) || empty($id) || $this->format!='json' ) $this->error();

        $item = $this->model->get($id);
        if( empty($item) ) $this->error();

        $bookmark = isset($_REQUEST['value']) ? $_REQUEST['value']: false;
        $bookmark = !empty($bookmark) ? 0: 1;

        $this->model->update( $id, array('cus_bookmark'=>$bookmark) );

        $arr['value'] = $bookmark;
        $arr['message'] = 'บันทึกเรียบร้อย';

        echo json_encode( $arr );
    }
    public function setdata($id='', $field=null) {
        if( empty($id) || empty($field) || empty($this->me) ) $this->error();

        $item = $this->model->get( $id );

        if( empty($item) ) $this->error();

        if( isset($_REQUEST['has_image_remove']) && !empty($item['image_id']) ){
            $this->model->query('media')->del( $item['image_id'] );
        }

        $data[$field] = isset($_REQUEST['value'])? $_REQUEST['value']:'';
        $this->model->update($id, $data);

        $arr['message'] = 'บันทึกเรียบร้อย';
        echo json_encode($arr);
    }


    /**/
    /* invite */
    /**/
    public function invite() {
        
        $data = $this->model->lists( array('view_stype'=>'bucketed', 'limit' => 20) );

        $results = array();
        $results[] = array(
            'object_type'=>'customers', 
            'object_name'=>'Customers',
            'data' => $data
        );

        echo json_encode($results); die;
    }

    /**/
    /* newcomers */
    /**/
    public function newcomers($id=null) {
        // print_r($this->model->query('customers')->lists( ));die;
        $this->view->setPage('on', 'newcomers' );

        if( !empty($id) ){

        }
        else{

            Session::init();
            // print_r($settings); die;

            if( $this->format=='json' ) {

                Session::set('customers_settings', array(
                    'company' => isset($_REQUEST['company']) ? $_REQUEST['company']:''
                ));

                $this->view->setData('results', $this->model->query('customers')->lists() );
                $render = "customers/newcomers/lists/json";
            }
            else{

                $settings = Session::get('customers_settings');
                $this->view->setData('settings', !empty($settings) ? $settings:array() );

                // $this->view->setData('groups', $this->model->query('companies')->groups() );
                $this->view->setData('company', $this->model->query('customers')->company() );
                $render = "customers/newcomers/lists/display";
            }

            $this->view->render($render);

        }
    }
    
    public function import() {

        if( !empty($_FILES) ){
            $target_file = $_FILES['file1']['tmp_name'];

            require WWW_LIBS. 'PHPOffice/PHPExcel.php';
            require WWW_LIBS. 'PHPOffice/PHPExcel/IOFactory.php';

            $inputFileName = $target_file;
            $inputFileType = PHPExcel_IOFactory::identify($inputFileName);
            $objReader = PHPExcel_IOFactory::createReader($inputFileType);
            $objReader->setReadDataOnly(true);
            $objPHPExcel = $objReader->load($inputFileName);

            $objWorksheet = $objPHPExcel->setActiveSheetIndex(0);
            $highestRow = $objWorksheet->getHighestRow();
            $highestColumn = $objWorksheet->getHighestColumn();

            $headingsArray = $objWorksheet->rangeToArray('A1:' . $highestColumn . '1', null, true, true, true);
            $headingsArray = $headingsArray[1];

            $r = -1;
            $data = array();
            $startRow = isset($_REQUEST['start_row']) ? $_REQUEST['start_row']:2;

            for ($row = $startRow; $row <= $highestRow; ++$row) {
                $dataRow = $objWorksheet->rangeToArray('A' . $row . ':' . $highestColumn . $row, null, true, true, true);

                ++$r;
                $col = 0;
                foreach ($headingsArray as $columnKey => $columnHeading) {
                    $val = $dataRow[$row][$columnKey];

                    $text = '';
                    foreach (explode(' ', trim($val)) as $value) {
                        if( empty($value) ) continue;
                        $text .= !empty($text) ? ' ':'';
                        $text .= $value;
                    }

                    $data[$r][$col] = $text;
                    $col++;
                }

            }

            // print_r($data); die;

            $fdata = array();
            foreach ($data as $key => $value) {
                
                $postData = array(
                    'cus_name' => trim($value[0])
                );

                $ex = explode(' ', $postData['cus_name']);

                $text = '';
                foreach ($ex as $val) {
                    $text .= !empty($text) ? ' ':'';
                    $text .= trim($val);
                }
                $ex = explode(' ', $text);


                if( count($ex)==4 ){
                    $postData['cus_prefix_name'] = $ex[0];
                    $postData['cus_first_name'] = $ex[1];
                    $postData['cus_middle_name'] = $ex[2];
                    $postData['cus_last_name'] = $ex[3];
                }else if( count($ex)==3 || count($ex)==5 ){
                    $postData['cus_prefix_name'] = $ex[0];
                    $postData['cus_first_name'] = $ex[1];
                    $postData['cus_last_name'] = $ex[2];
                }else if( count($ex)==2 ){
                    $postData['cus_first_name'] = $ex[0];
                    $postData['cus_last_name'] = $ex[1];
                }
                else{
                    $postData['first_name'] = $text;
                }

                $postData['cus_status'] = 'newcomers';
                $postData['cus_company_id'] = $value[2];
                $fdata[] = $postData;
                
                // $this->model->insert( $postData );
            }

            print_r($fdata); die;
        }

        if( empty($this->me) || $this->format!='json' ) $this->error();



        $this->view->setPage('path','Forms/customers');
        $this->view->render("import");
    }
}