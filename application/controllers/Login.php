<?php

class Login extends MY_Controller{

    public function index(){
        $this->load->view('public/adminLogin');
    }

    public function adminLogin(){
        
        $this->load->library('form_validation');

        // setting up error style
        $this->form_validation->set_error_delimiters('<div class="text-danger mt-4">','</div>');

        // checking validation by verifying the rules from config/form_validation.php -> $config array
        
        // using ternary operators
        //$this->form_validation->run('login') ? '' : $this->load->view('public/adminLogin');

        if( $this->form_validation->run('login') ){
            $username = $this->input->post('username');
            $password = $this->input->post('password');

            echo "Welcome $username, you logged in by typing $password as password.";
        }else{
            $this->load->view('public/adminLogin');
        }
    }
}


