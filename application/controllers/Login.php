<?php

class Login extends MY_Controller{

    public function index(){
        $this->session->userdata('login_id') ? redirect('admin/dashboard') : '';
        $this->load->view('public/adminLogin');
    }

    public function adminLogin(){
        
        $this->load->library('form_validation');

        // setting up error style
        $this->form_validation->set_error_delimiters('<div class="text-danger mt-4"><b>*</b> ','</div>');

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
                if($result){
                    // authentication successful
                    foreach($result as $row){
                        $this->session->set_userdata('login_id',$row->id);
                    }
                    return redirect('admin/dashboard');
                }else{
                    // authentication failed
                    $this->session->set_flashdata('login_failed','Invalid Username/Password');
                    $this->load->view('public/adminLogin');
                }
            }else{
                // if the password doesn't match, redirect to login page displaying the error.
                $this->session->set_flashdata('login_failed','Invalid Username/Password');
                $this->load->view('public/adminLogin');
            }
            /*
            if($db_password){
                $passwordverify = password_verify($password, $db_password);
                $data['result'] = $passwordverify;
                $this->load->view('public/adminLogin',$data);
            }else{
                echo "Failed";
            }
            */
        }else{
            $this->load->view('public/adminLogin');
        }
    }

    public function logout(){
        $this->session->unset_userdata('login_id');
        $this->session->sess_destroy();
        return redirect('login');
    }
}


