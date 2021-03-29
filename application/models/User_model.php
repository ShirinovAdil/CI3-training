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
        // by username and pwd
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

    public function get_user_by_id($user_id){
        $this->db->where('id', $user_id);
        return $this->db->get('tb_users')->row_array();
    }

    public function update_user_by_id($user_id, $form_array){
        $this->db->where('id', $user_id);
        $this->db->update('tb_users', $form_array);
    }


    public function delete_user_by_id($user_id){
        // delete user by ID but not root user
        $this->db->select('*');
        $this->db->from('tb_users');
        $this->db->where('id', $user_id);
        $result=$this->db->get();
        if ($result->num_rows()) {
             $fetched_user = $result->row();
            if($fetched_user -> role != "root"){
                $this->db->delete('tb_users', array('id' => $user_id));
                return true;
            }else{
                return false;
            }
        } else {
            return false;
        }
    }

    function role_enums($table , $field){
        // returns role enum

        $query = "SHOW COLUMNS FROM ".$table." LIKE '$field'";
        $row = $this->db->query("SHOW COLUMNS FROM ".$table." LIKE '$field'")->row()->Type;
        $regex = "/'(.*?)'/";
        preg_match_all( $regex , $row, $enum_array );
        $enum_fields = $enum_array[1];
        foreach ($enum_fields as $key=>$value)
        {
            $enums[$value] = $value;
        }
        return $enums;
    }

}