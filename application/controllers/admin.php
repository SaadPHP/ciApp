<?php

class Admin extends MY_Controller{

    // Admin controller
    public function __construct(){
        parent::__construct();
        !$this->session->userdata('login_id') ? redirect('login') : '';
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

    public function retDash(){
        return redirect('admin/Dashboard');
    }

    public function store_article(){
        
        $this->load->library('form_validation');
        $this->form_validation->set_error_delimiters('<div class="text-danger mt-4"><b>*</b> ','</div>');

        if( $this->form_validation->run('add_article') ){
            // if form validation passes then proceed

            // getting values from form
            $title      = $this->input->post('title');
            $body       = $this->input->post('body');
            $author_id  = $this->session->userdata('login_id');

            // loading model to pass form values to model function
            $this->load->model('articlesmodel','am');
            if( $this->am->__storeArticle($title, $body, $author_id) ){
                // data inserted successfully, show flashdata
                $this->session->set_flashdata('articleStatus','Article added successfully');
                $this->session->set_flashdata('statusClass','alert-success');
            }else{
                // data was not inserted, show flashdata
                $this->session->set_flashdata('articleStatus','Oops..! Something went wrong, please try again!');
                $this->session->set_flashdata('statusClass','alert-danger');
            }

            return redirect('admin/dashboard');
        }else{
            // if validation fails, then reloads the add article page
            $this->load->view('admin/add_Article.php');
        }
    }

    public function add_article(){
        $this->load->view('admin/add_Article.php');
        
    }

    public function edit_article(){

    }

    public function delete_article(){

    }

}




