<?php

class Blog_Controller extends Controller {

    public function __construct() {
        parent::__construct();
    }

    public function index() {


        
        $this->view->render("blog/display"); 
    }


    /* --  Actions -- */
    public function add( $action='' ) {

        if( empty($this->me) || $this->format!='json' ) $this->error();

        $path = 'Themes/admin/forms/blog';
        $path .= !empty($action) ? "/{$action}":'';

        if( $action=='category' ){
            $forums = $this->model->forum->find();
            $this->view->setData( 'forumsList', $forums['items'] );
            
        }

        $this->view->setPage('path', $path);
        $this->view->render("add"); 
    }
    public function edit( $action='', $id=null )
    {
        if( is_numeric($action) && $id==null ){
            $item = $this->model->get($action);
            $this->view->setData('item', $item);
            $this->add();
        }
        else{
            $item = $this->model->{$action}->get($id);
            if( empty($item) ) $this->error();
            $this->view->setData('item', $item);
            $this->add( $action );
        }
    }
    public function save( $action='' ) {

        if( empty($this->me) || $this->format!='json' || empty($_POST) ) $this->error();


        /* Save: forum  */
        if( $action=='forum' ) {
            $id = isset($_POST['id']) ? $_POST['id']: null;
            if( !empty($id) ){
                $item = $this->model->forum->get($id);
                if( empty($item) ) $this->error();
            }

            try {

                $form = new Form();
                $form   ->post('forum_name')->val('is_empty');

                $form->submit();
                $postData = $form->fetch();

                if( empty($arr['error']) ){

                    if( !empty($item) ){
                        $this->model->forum->update( $id, $postData );
                    }
                    else{
                        $this->model->forum->insert( $postData );
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
                $item = $this->model->category->get($id);
                if( empty($item) ) $this->error();
            }

            try {
                $form = new Form();
                $form   ->post('cry_name')->val('is_empty')
                        ->post('cry_forum_id')->val('is_empty');

                $form->submit();
                $postData = $form->fetch();

                if( empty($arr['error']) ){

                    if( !empty($item) ){
                        $this->model->category->update( $id, $postData );
                    }
                    else{
                        $this->model->category->insert( $postData );
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
        else if( $action=='' ){

        }
        else{
            $arr['error'] = 400;
        }
        

        echo json_encode($arr);
    }
    public function del( $action='', $id=null ) {
        
        $id = isset($_REQUEST['id']) ? $_REQUEST['id']: $id;
        $path = 'Themes/admin/forms/blog';
        
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

                if( !empty($action)  ){
                    
                    $this->model->{$action}->delete( $id );
                }
                else{
                	$this->model->delete( $id );
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