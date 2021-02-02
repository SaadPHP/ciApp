<?php

class Articlesmodel extends CI_Model{

    public function __getArticles(){
        $login_id = $this->session->userdata('login_id');
        $q = $this->db->where('author_id',$login_id)
                    ->get('articles');
        return $q->result();
    }

    public function __getUserName($id){
        $q = $this->db->where('id',$id)
                ->get('users');
        return $q->row('uname');
    }

    public function __storeArticle($title, $body, $author_id){
        $data = array(
            'title'     => $title,
            'body'      => $body,
            'author_id' => $author_id
        );
        return $this->db->insert('articles',$data); // returns affected rows count
    }

    public function __updateArticle($title, $body, $article_id){
        
        $user_id = $this->session->userdata('login_id');
        $data = array(
            'title'     => $title,
            'body'      => $body
        );

        return $this->db->where('id', $article_id)
                        ->update('articles', $data);
    }

    public function __fetchArticleDetails($article_id, $user_id){
        $q = $this->db->where(['id' => $article_id, 'author_id' => $user_id])
                        ->get('articles');
        return $q->row();
    }
}





