<?php

class User_model extends CI_Model {

    public $id;
    public $username;
    public $password;

    public function get_last_ten_entries()
    {
        $query = $this->db->get('tb_users', 10);
        return $query->result();
    }

    public function insert_user($data){
        $this->db->insert("tb_users", $data);
    }

    public function fetch_user($username, $password){
        $array = array('username' => $username, 'password' => $password);

        $this->db->select('*');
        $this->db->from('tb_users');
        $this->db->where($array);
        $result=$this->db->get();
        if ($result->num_rows()) {
            return $result->row();
        } else {
            return false;
        }
    }

    public function get_all_users(){
        // Model method to return all users
        $query = $this->db->get('tb_users');
        return $query->result();
    }

}