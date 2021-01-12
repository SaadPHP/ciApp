<?php

class User extends MY_Controller{

    // Public controller
    public function index(){
        $this->load->view('public/articles_list');
    }


}


