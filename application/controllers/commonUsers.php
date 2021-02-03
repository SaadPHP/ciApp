<?php

class CommonUsers extends MY_Controller{

    // Public controller
    // constructor
    public function __construct(){
        parent::__construct();
        !$this->session->userdata('login_id') ? redirect('login') : '';

        // loading model
        $this->load->model('loginmodel','lm'); // 2nd param is for shortname of model

        // loading articles model
        $this->load->model('articlesmodel','am');

        // loading form validation library
        $this->load->library('form_validation');
    }

    // function that loads all the articles on homepage
    public function publicdashboard(){

        //retrieving value from session
        $id = $this->session->userdata('login_id');

        // loading pagination
        $this->load->library('pagination');
        $config = array(
            
            // base options
            "base_url"          => base_url('commonUsers/publicDashboard'),
            "per_page"          => 5,
            "total_rows"        => $this->am->__getArticleByUser($id),
            
            // first and last
            "first_link"        => "&larr;First",
            "last_link"         => "&rarr;Last",
            
            // outer body of pagination
            "full_tag_open"     => "<ul class='pagination'>",
            "full_tag_close"    => "</ul>",
            
            // first tag
            "first_tag_open"    => "<li class='page-link'>",
            "first_tag_close"   => "</li>",
            
            // last tag
            "last_tag_open"     => "<li class='page-link'>",
            "last_tag_close"    => "</li>",
            
            // next tag
            "next_tag_open"     => "<li class='page-link'>",
            "next_tag_close"    => "</li>",
            "next_link"         => "Next",
            
            // previous tag
            "prev_tag_open"     => "<li class='page-link'>",
            "prev_tag_close"    => "</li>",
            "prev_link"         => "Previous",
            
            // numbers tag
            "num_tag_open"      => "<li class='page-link'>",
            "num_tag_close"     => "</li>",
            
            // current active tag
            "cur_tag_open"      => "<li class='active page-item'><a class='page-link'>",
            "cur_tag_close"     => "</a></li>"
        );

        $this->pagination->initialize($config);

        //passing session variable to model function
        $res = $this->lm->get_details($id);
        
        if($res){
            $data['result'] = $res;
        }else{
            return false;
        }

        $data['articles']       = $this->am->__getArticles($config['per_page'], $this->uri->segment(3));
        $data['username']       = $this->am->__getUserName($id);
        $data['totalArticles']  = $this->am->__getArticleByUser($id);

        // passing session user values from db to view & also articles data to view
        $this->load->view('public/publicDashboard',$data);
    }

    // function that returns back to main page
    public function retDash(){
        return redirect('commonUsers/publicDashboard');
    }

    // function that insert a single article
    public function store_article(){
        
        $this->form_validation->set_error_delimiters('<div class="text-danger mt-4"><b><i class="fas fa-exclamation-circle"></i></b> ','</div>');
        if( $this->form_validation->run('add_article') ){
            // if form validation passes then proceed
            // getting values from form
            $title      = $this->input->post('title');
            $body       = $this->input->post('body');
            $author_id  = $this->session->userdata('login_id');

            return $this->_flashAndRedirect($this->am->__storeArticle($title, $body, $author_id), 'Article added successfully');
        }else{
            // if validation fails, then reloads the add article page
            $this->load->view('public/add_Article');
        }
    }

    // function that initiates the insertion process of article by loading a view
    public function add_article(){
        $this->load->view('public/add_Article');
    }

    // function that handles the edit request and start the updates function via view
    public function edit_article($article_id){

        // retrieving session variable
        $user_id = $this->session->userdata('login_id');

        // assigning the value to array fetched from model 
        $data['article_details'] = $this->am->__fetchArticleDetails($article_id, $user_id);
        
        // passing an array to view to populate edit form with respective article
        $this->load->view('public/edit_Article', $data);
    }

    // function that updates a single article
    public function update_article($article_id){

        $this->form_validation->set_error_delimiters('<div class="text-danger mt-4"><b><i class="fas fa-exclamation-circle"></i></b> ','</div>');
        if( $this->form_validation->run('add_article') ){
            // if form validation passes then proceed
            // getting values from form
            $title = $this->input->post('title');
            $body  = $this->input->post('body');

            return $this->_flashAndRedirect($this->am->__updateArticle($title, $body, $article_id), 'Article updated successfully');
        }else{
            // if validation fails, then reloads the edit article page
            $user_id = $this->session->userdata('login_id');
            $data['article_details'] = $this->am->__fetchArticleDetails($article_id, $user_id);
            $this->load->view('public/edit_Article',$data);
        }
    }

    // function that deletes a single article
    public function delete_article($article_id){    
        return $this->_flashAndRedirect($this->am->__deleteArticle($article_id),'Article deleted successfully');
    }

    // function that's created to avoid DRY methodology, will be used when article is created, updated or deleted
    private function _flashAndRedirect($status, $successMsg){
        if( $status ){
            // data deleted successfully, show flashdata
            $this->session->set_flashdata('articleStatus',$successMsg);
            $this->session->set_flashdata('statusClass','alert-success');
        }else{
            // data was not deleted, show flashdata
            $this->session->set_flashdata('articleStatus','Oops..! Something went wrong, please try again!');
            $this->session->set_flashdata('statusClass','alert-danger');
        }
        return redirect('commonUsers/publicDashboard');
    }
}