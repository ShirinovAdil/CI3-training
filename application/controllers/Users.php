<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Users extends CI_Controller {


    public function index()
    {
        $this->load->model('User_model');
        $this->load->helper('url');
    }

    public function all()
    {
        $this->load->model("User_model"); // load model
        $query = $this->User_model->get_last_ten_entries();

        foreach ($query as $row)
        {
            echo $row->id .'. ' . $row->username .' password: ' . $row->password;
            echo "<br/>";
        }
    }


    public function login(){
        $this->load->view('layout/header');
        $this->load->view('auth/login');
    }


    public function login_validation(){
        $this->load->library('form_validation');
        $this->form_validation->set_rules('username', 'Username', 'required');
        $this->form_validation->set_rules('password', 'Password', 'required');

        if($this->form_validation->run()) {

            $this->load->model("User_model"); // load model

            $username = $this->input->post('username');  // get post request input data
            $password = $this->input->post('password');

            $user = $this->User_model->fetch_user($username, $password);
            if($user){
               echo "Success login";
            }else{
                echo "Login failed";
            }
        }else{
            $this->login(); //render login form
        }

    }





}
