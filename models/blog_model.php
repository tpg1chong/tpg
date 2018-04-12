<?php

# import
require_once 'Blog/Forum.php';
require_once 'Blog/Category.php';

class Blog_Model extends Model{

    public function __construct() {
        parent::__construct();
        
        $this->forum = new Forum();
        $this->category = new Category();
    }


}