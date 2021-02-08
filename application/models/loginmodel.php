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

    public function get_details($id){
        $q = $this->db->where('id', $id)
                    ->get('users');
        return $q->result();
    }

    public function check_role($user_id){
        $q = $this->db->select('role_id')
                        ->where('id', $user_id)
                        ->get('users');
        return $q->row();
    }
}


