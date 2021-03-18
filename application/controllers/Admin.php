<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Admin extends CI_Controller {

    private $ROLES  = array("root", "moderator", "admin", "user");

    public function __construct()
    {
        parent::__construct();
        $this->load->library('form_validation');
        $this->load->model("User_model"); // load model
    }

    public function index($message=NULL)
    {
        if(!$this->is_authenticated()){
            $data = array('message' => $message);
            $this->load->view('layout/header');
            $this->load->view('admin/login', $data);
        }else{
            echo "You logged in already";
        }

    }


    public function check_role($role_list){
        // check if user has needed role

        $user_role = $this->session->userdata('userRole');
        if(in_array($user_role, $role_list)){
            return true;
        }else{
            return false;
        }
    }

    public function is_authenticated(){
        // check if user is logged in

        $userId = $this->session->userdata('userId');
        $userRole = $this->session->userdata('userRole');
        if($userId && $userRole){
            return true;
        }else{
            return false;
        }
    }

    public function login_validation(){
        // validation backend for login form

        $this->form_validation->set_rules('username', 'Username', 'required');
        $this->form_validation->set_rules('password', 'Password', 'required');

        if($this->form_validation->run()) {

            $username = $this->input->post('username');  // get post request input data
            $password = $this->input->post('password');

            $user = $this->User_model->fetch_user($username, $password);
            if($user){
                $session_data = array(
                    'userId' => $user->id,
                    'userRole' => $user->role
                );
                $this->session->set_userdata($session_data);
                //$this->dashboard(array("user"));
                redirect(base_url() . 'admin/dashboard');
            }else{
                $this->index(); //render login form
            }
        }else{
            $this->index(); //render login form
        }

    }

    function logout()
    {
        /* Controller to logout an admin user */

        $userId = $this->session->userdata('userId');
        $userRole = $this->session->userdata('userRole');
        $this->session->unset_userdata('userId');
        $this->session->unset_userdata('userRole');
        redirect(base_url() . 'admin');
    }

    public function dashboard($ALLOWED_ROLES=array("root", "admin")){
        if($this->check_role($ALLOWED_ROLES)){
            $users = $this->User_model->get_all_users();
            $data = array(
                "users" => $users
            );
            $this->load->view('layout/header');
            $this->load->view('admin/dashboard', $data);
        }else{
            echo "Permission not granted";
        }
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

    public function sessions(){

        $userId = $this->session->userdata('userId');
        $userRole = $this->session->userdata('userRole');
        echo $userId;
        echo '<br/>';
        echo $userRole;
    }



}
