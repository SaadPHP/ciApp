<?php

class Admin extends MY_Controller{

    // Admin controller
    public function index(){
        
    }

    public function dashboard(){

        // loading model to fetch session user details
        $this->load->model('loginmodel','lm'); // 2nd param is for shortname of model

        //retrieving value from session
        $id = $this->session->userdata('login_id');

        //passing session variable to model function
        $res = $this->lm->get_details($id);
        
        if($res){
            $data['result'] = $res;
        }else{
            return false;
        }

        // now loading articles model
        $this->load->model('articlesmodel','am');
        $data['articles'] = $this->am->__getArticles();
        $data['username'] = $this->am->__getUserName($id);

        // passing session user values from db to view & also articles data to view
        $this->load->view('admin/dashboard',$data);
    }

}




