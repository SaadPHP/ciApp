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



}





