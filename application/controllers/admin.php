<?php

class Admin extends MY_Controller{

    // Admin controller
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
    public function dashboard(){

        //retrieving value from session
        $id = $this->session->userdata('login_id');
        $check_role = $this->lm->check_role($id);
        
        if( $check_role->role_id == 2){
            return redirect('commonUsers/publicDashboard');
        }else{
            // loading pagination
            $this->load->library('pagination');
            $config = array(
                
                // base options
                "base_url"          => base_url('admin/dashboard'),
                "per_page"          => 5,
                "total_rows"        => $this->am->__countAllArticles(),
                
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

            $data['total_articles'] = $this->am->__countAllArticles();
            $data['articles']       = $this->am->__getAllArticles($config['per_page'], $this->uri->segment(3));

            // passing session user values from db to view & also articles data to view
            $this->load->view('admin/dashboard',$data);
        }
    }

    // function that returns back to main page
    public function retDash(){
        return redirect('admin/Dashboard');
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

            return $this->_flashAndRedirectAdm($this->am->__storeArticle($title, $body, $author_id), 'Article added successfully');
        }else{
            // if validation fails, then reloads the add article page
            $this->load->view('admin/add_Article');
        }
    }

    // function that initiates the insertion process of article by loading a view
    public function add_article(){
        $this->load->view('admin/add_Article');
    }

    // function that handles the edit request and start the updates function via view
    public function edit_article($article_id){

        // assigning the value to array fetched from model 
        $data['article_details'] = $this->am->__fetchAllArticleDetails($article_id);
        
        // passing an array to view to populate edit form with respective article
        $this->load->view('admin/edit_Article', $data);
    }

    // function that updates a single article
    public function update_article($article_id){

        $this->form_validation->set_error_delimiters('<div class="text-danger mt-4"><b><i class="fas fa-exclamation-circle"></i></b> ','</div>');
        if( $this->form_validation->run('add_article') ){
            // if form validation passes then proceed
            // getting values from form
            $title = $this->input->post('title');
            $body  = $this->input->post('body');

            return $this->_flashAndRedirectAdm($this->am->__updateArticle($title, $body, $article_id), 'Article updated successfully');
        }else{
            // if validation fails, then reloads the edit article page
            $user_id = $this->session->userdata('login_id');
            $data['article_details'] = $this->am->__fetchArticleDetails($article_id, $user_id);
            $this->load->view('admin/edit_Article',$data);
        }
    }

    // function that deletes a single article
    public function delete_article($article_id){    
        return $this->_flashAndRedirectAdm($this->am->__deleteArticle($article_id),'Article deleted successfully');
    }

    // function that's created to avoid DRY methodology, will be used when article is created, updated or deleted
    private function _flashAndRedirectAdm($status, $successMsg){
        if( $status ){
            // data deleted successfully, show flashdata
            $this->session->set_flashdata('articleStatus',$successMsg);
            $this->session->set_flashdata('statusClass','alert-success');
        }else{
            // data was not deleted, show flashdata
            $this->session->set_flashdata('articleStatus','Oops..! Something went wrong, please try again!');
            $this->session->set_flashdata('statusClass','alert-danger');
        }
        return redirect('admin/dashboard');
    }

    // function that is used to search via Ajax
    public function searchArticles(){
        $res = $this->input->post('search_val');
    
        $data = $this->am->search_posts_admin($res);
        echo json_encode($data);
    }
}




