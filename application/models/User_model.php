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

}