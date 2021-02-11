<?php

class Articlesmodel extends CI_Model{

    // returns the complete articles table data of the current login user
    public function __getArticles($limit, $offset){
        $login_id = $this->session->userdata('login_id');
        $q = $this->db->where('author_id',$login_id)
                    ->limit($limit, $offset)
                    ->order_by('created_on', 'DESC')
                    ->get('articles');
        return $q->result();
    }

    // returns the username
    public function __getUserName($id){
        $q = $this->db->where('id',$id)
                ->get('users');
        return $q->row('uname');
    }

    // returns the number of rows affected by inserting a record in articles table
    public function __storeArticle($title, $body, $author_id){
        $data = array(
            'title'     => $title,
            'body'      => $body,
            'author_id' => $author_id
        );
        return $this->db->insert('articles',$data); // returns affected rows count
    }

    // returns the number of rows affected after updating a record in articles table 
    public function __updateArticle($title, $body, $article_id){
        
        $user_id = $this->session->userdata('login_id');
        $data = array(
            'title'     => $title,
            'body'      => $body
        );

        return $this->db->where('art_id', $article_id)
                        ->update('articles', $data);
    }

    // returns the information of a single article [ given article id and author id ] 
    public function __fetchArticleDetails($article_id, $user_id){
        $q = $this->db->where(['art_id' => $article_id, 'author_id' => $user_id])
                        ->get('articles');
        return $q->row();
    }

    // creating a function for admin to edit specific article created by others or by himself
    public function __fetchAllArticleDetails($article_id){
        $q = $this->db->where('art_id', $article_id)
                        ->get('articles');
        return $q->row();
    }

    // returns the number of rows affected after deleting a single article
    public function __deleteArticle($article_id){
        return $this->db->delete('articles',['art_id'=>$article_id]);
    }

    // returns the number of articles present for currently login member
    public function __getArticleByUser($id){
        
        $q = $this->db->where('author_id', $id)
                ->count_all_results('articles');
        return $q;
    }

    // returns total number of articles
    public function __countAllArticles(){
        $this->db->join('users','users.id = articles.author_id','inner');
        $this->db->where('users.is_Active', 1);
        return $this->db->count_all_results('articles');
    }

    // returns all Articles
    public function __getAllArticles($limit, $offset){
        $q = $this->db->select('*')
                    ->join('users','users.id = articles.author_id','left')
                    ->limit($limit, $offset)
                    ->order_by('articles.created_on', 'DESC')
                    ->get('articles');
        return $q->result();
    }

    // function for getting the results for search
    public function search_posts($res, $id){
        $sql = "SELECT `art_id`, `title`, `body`, `author_id`, `created_on` FROM `articles` 
                           WHERE `author_id` = ".$this->db->escape($id)." AND 
                           (`title` LIKE '%".$this->db->escape_like_str($res)."%' ESCAPE '!' OR `body` LIKE '%".$this->db->escape_like_str($res)."%' ESCAPE '!')";
        $q = $this->db->query($sql);
        return $q->result();
    }

    // function that returns the total number of rows returned from search
    public function search_posts_count($res, $id){
        $sql = "SELECT COUNT(*) as `Total` FROM `articles` 
                           WHERE `author_id` = ".$this->db->escape($id)." AND 
                           (`title` LIKE '%".$this->db->escape_like_str($res)."%' ESCAPE '!' OR `body` LIKE '%".$this->db->escape_like_str($res)."%' ESCAPE '!')";
        $q = $this->db->query($sql);
        return $q->result();
    }
}





