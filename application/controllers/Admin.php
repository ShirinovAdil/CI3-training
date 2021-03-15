<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Admin extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        $this->load->helper('url');
        $this->load->library('form_validation');
        $this->load->library('session');
        $this->load->model("User_model"); // load model

    }

    public function index($message=NULL)
    {
        $data = array('message' => $message);
        $this->load->view('layout/header');
        $this->load->view('admin/login', $data);
    }

    public function login_validation(){

        $this->form_validation->set_rules('username', 'Username', 'required');
        $this->form_validation->set_rules('password', 'Password', 'required');

        if($this->form_validation->run()) {

            $username = $this->input->post('username');  // get post request input data
            $password = $this->input->post('password');

            $user = $this->User_model->fetch_user($username, $password);
            if($user){
                if($user->is_staff){
                    $this->session->set_userdata('userId', $user->id);
                    redirect(base_url() . 'admin/dashboard');
                }else{
                    $message = "Not correct admin credentials";
                    $this->index($message);
                }
            }else{
                $this->index(); //render login form
            }
        }else{
            $this->index(); //render login form
        }

    }

    public function dashboard(){
        $name = $this->session->userdata('userId');
        echo "ADMIN DASHBOARD";
        echo $name;
    }

    public function all()
    {
        $query = $this->User_model->get_last_ten_entries();

        foreach ($query as $row)
        {
            echo $row->id .'. ' . $row->username .' password: ' . $row->password;
            echo "<br/>";
        }
    }



}
