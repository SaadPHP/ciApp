<?php

class UserRegistration extends MY_Controller{

    public function index(){
        $this->session->userdata('login_id') ? redirect('commonUsers/publicDashboard') : '';
        $this->load->view('public/registration');
    }

    public function registerUser(){
        
        $this->load->library('form_validation');
        $this->form_validation->set_error_delimiters('<div class="error mt-4"><i class="fas fa-exclamation-circle"></i> ','</div>');

        if ( $this->form_validation->run('registration') ){

            $username   = $this->input->post('username');
            $password   = $this->input->post('password');

            // hashing password by using default function password_hash
            $passwordhash = password_hash($password,PASSWORD_DEFAULT);

            $firstname  = $this->input->post('firstname');
            $lastname   = $this->input->post('lastname');
            $userRole   = $this->input->post('roles');

            // loading model for registration
            $this->load->model('registrationmodel');
            $this->registrationmodel->signup($username, $passwordhash, $firstname, $lastname, $userRole);

        }else{
            $this->load->view('public/registration');
        }


    }



}
