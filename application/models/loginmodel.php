<?php

class Loginmodel extends CI_Model{

    public function authorize($username, $password){
        
        $q = $this->db->where(['uname' => $username, 'password' => $password])
                ->get('users');

        $num = $q->num_rows();
        if( $num == 1){
            return $q->result();
        }else{
            return false;
        }
    }

    public function checkpassword($username){
        $q = $this->db->where('uname', $username)
                    ->get('users');
        return $q->row('password');
    }


}


