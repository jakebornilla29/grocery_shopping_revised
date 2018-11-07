<?php
class Login_model extends CI_Model
{
    function checkUser($login,$password){
        $query = $this->db->select()
        				  ->where(['email'=> $login , 'password'=> $password])
        				  ->or_where(['username'=> $login , 'password'=> $password])
        				  ->get('users');
        return $query->result();
    }
}