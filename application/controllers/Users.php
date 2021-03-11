<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Users extends CI_Controller {

    public function index()
    {
        echo "index";
    }

    public function hi()
    {
        echo "hi";
    }

    public function all()
    {
        $this->load->model('User_model');

        $query = $this->User_model->get_last_ten_entries();

        foreach ($query as $row)
        {
            echo $row->id;
            echo $row->username;
            echo $row->password;
        }
    }


    public function login(){
        $this->load->helper('url');

        $this->load->view('layout/header');
        $this->load->view('auth/login');

    }


    public function login_validation(){
        $this->load->library('form_validation');
        $this->form_validation->set_rules('username', 'Username', 'required');
        $this->form_validation->set_rules('password', 'Password', 'required');

        if($this->form_validation->run()) {
            $username = $this->input->post('username');
            $password = $this->input->post('password');

            $array = array('username' => $username, 'password' => $password);
            echo $this->db->where($array);


        }else{
            $this->login();
        }

    }





}
