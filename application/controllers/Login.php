<?php

class Login extends MY_Controller{

    public function index(){
        $this->session->userdata('login_id') ? redirect('admin/dashboard') : '';
        $this->load->view('public/publicLogin');
    }

    public function publicLogin(){
        
        $this->load->library('form_validation');

        // setting up error style
        $this->form_validation->set_error_delimiters('<div class="error mt-4"><b><i class="fas fa-exclamation-circle"></i></b> ','</div>');

        // checking validation by verifying the rules from config/form_validation.php -> $config array
        
        // using ternary operators
        //$this->form_validation->run('login') ? '' : $this->load->view('public/adminLogin');

        if( $this->form_validation->run('login') ){
            $username = $this->input->post('username');
            $password = $this->input->post('password');

            // loading model
            $this->load->model('loginmodel');

            // verifying password hash from db
            $db_password = $this->loginmodel->checkpassword($username);
            if(password_verify($password, $db_password)){
                // if password matches from the db hashed password then call the authorize func in loginmodel
                $result = $this->loginmodel->authorize($username, $db_password);
                foreach($result as $row){

                    // check which user role is trying to log in
                    if($row->role_id == 2){
                        // continue successful authentication ( 2 is for common public & 1 is for Admin )
                        $this->session->set_userdata('login_id',$row->id);
                        return redirect('commonUsers/publicDashboard');
                    }else{
                        // redirect to login page with the message that this platform is for common public only (because role id is 1 -> Admin )
                        $this->session->set_flashdata('login_failed_notice','<i class="fas fa-exclamation-triangle"></i> You\'re trying to access Public section with Admin credentials, kindly try Admin Login!');
                        $this->load->view('public/publicLogin');
                    }
                }
            }else{
                // if the password doesn't match, redirect to login page displaying the error.
                $this->session->set_flashdata('login_failed','<i class="fas fa-exclamation-triangle"></i> Invalid Username/Password');
                $this->load->view('public/publicLogin');
            }
        }else{
            $this->load->view('public/publicLogin');
        }
    }

    public function logout(){
        $this->session->unset_userdata('login_id');
        $this->session->sess_destroy();
        return redirect('login');
    }
}


