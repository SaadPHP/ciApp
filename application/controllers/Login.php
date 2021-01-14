<?php

class Login extends MY_Controller{

    public function index(){
        $this->load->view('public/articles_list');
    }

    public function adminLogin(){
        echo "Welcome to Home screen";
    }
}


