<?php

class Registrationmodel extends CI_Model{

    public function signup($username, $password, $firstname, $lastname){

        $date = date('Y-m-d H:i:s');
        $data = array(
            'uname'         => $username,
            'password'      => $password,
            'fname'         => $firstname,
            'lname'         => $lastname,
            'created_at'    => $date,
            'is_Active'     => 1
        );

        $query = $this->db->insert('users',$data);
        if ( $query ){
            $this->load->view('public/adminLogin');
        }else{
            $this->load->view('public/registration');
            $this->db->error();
        }

    }



}




