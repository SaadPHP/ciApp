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
            $this->load->view('admin/add_Article');
        }
    }

    public function add_article(){
        $this->load->view('admin/add_Article');
    }

    public function edit_article($article_id){

        // loading model
        $this->load->model('articlesmodel','am');

        // retrieving session variable
        $user_id = $this->session->userdata('login_id');

        // assigning the value to array fetched from model 
        $data['article_details'] = $this->am->__fetchArticleDetails($article_id, $user_id);
        
        // passing an array to view to populate edit form with respective article
        $this->load->view('admin/edit_Article', $data);

    }

    public function update_article($article_id){
        $this->load->library('form_validation');
        $this->form_validation->set_error_delimiters('<div class="text-danger mt-4"><b>*</b> ','</div>');

        if( $this->form_validation->run('add_article') ){
            // if form validation passes then proceed

            // getting values from form
            $title = $this->input->post('title');
            $body  = $this->input->post('body');

            // loading model to pass form values to model function
            $this->load->model('articlesmodel','am');
            if( $this->am->__updateArticle($title, $body, $article_id) ){
                // data inserted successfully, show flashdata
                $this->session->set_flashdata('articleStatus','Article updated successfully');
                $this->session->set_flashdata('statusClass','alert-success');
            }else{
                // data was not inserted, show flashdata
                $this->session->set_flashdata('articleStatus','Oops..! Something went wrong, please try again!');
                $this->session->set_flashdata('statusClass','alert-danger');
            }

            return redirect('admin/dashboard');
        }else{
            // if validation fails, then reloads the edit article page

            $user_id = $this->session->userdata('login_id');
            $this->load->model('articlesmodel','am');
            $data['article_details'] = $this->am->__fetchArticleDetails($article_id, $user_id);
            $this->load->view('admin/edit_Article',$data);
        }
    }

    public function delete_article(){

    }

}




