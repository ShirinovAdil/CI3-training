<?php
defined('BASEPATH') or exit('No direct script access allowed');

class   Admin extends CI_Controller
{

    private $ROLES = array("root", "moderator", "admin", "user");

    public function __construct()
    {
        parent::__construct();
        $this->load->model("User_model"); // load model
        $this->load->model("Admin_model"); // load model
    }

    public function index($message = NULL)
    {
        redirect(base_url('admin/login'));
    }

    public function login(){
        if (!$this->is_authenticated()) {
            $this->load->view('admin/login');
        }else{
            redirect(base_url('admin/dashboard'));
        }
    }

    public function check_role($role_list)
    {
        // :Service - Check if user has needed role

        $user_role = $this->session->userdata('userRole');
        if (in_array($user_role, $role_list)) {
            return true;
        } else {
            return false;
        }
    }


    public function is_authenticated()
    {
        // :Service - Check if user is logged in

        $userId = $this->session->userdata('userId');
        $userRole = $this->session->userdata('userRole');
        if ($userId && $userRole) {
            return true;
        } else {
            return false;
        }
    }

    public function login_validation()
    {
        // :Service - Validation backend for login form

        $this->form_validation->set_rules('username', 'Username', 'required');
        $this->form_validation->set_rules('password', 'Password', 'required');

        if ($this->form_validation->run()) {

            $username = $this->input->post('username');  // get post request input data
            $password = $this->input->post('password');

            $user = $this->User_model->fetch_user($username, $password);
            if ($user) {
                $session_data = array(
                    'userId' => $user->id,
                    'userRole' => $user->role
                );
                $this->session->set_userdata($session_data);
                redirect(base_url() . 'admin/dashboard');
            } else {
                //$this->session->set_flashdata('success', 'Success Message...');
                //$this->session->set_flashdata('warning', 'Warning Message...');
                //$this->session->set_flashdata('info', 'Info Message...');
                $this->session->set_flashdata('error', 'Wrong credentials were provided');
                redirect(base_url('admin/login'));
            }
        } else {
            redirect(base_url('admin/login'));
        }

    }

    function logout()
    {
        // path("admin/logout")
        /* Logout an admin user */

        $userId = $this->session->userdata('userId');
        $userRole = $this->session->userdata('userRole');
        $this->session->unset_userdata('userId');
        $this->session->unset_userdata('userRole');
        redirect(base_url('admin/login'));
    }

    public function dashboard($ALLOWED_ROLES = array("root", "admin"))
    {
        // path("admin/dashboard")
        /* Render admin dashboard  */

        $header_data = array(
            "is_authenticated" => $this->is_authenticated()
        );

        if ($this->check_role($ALLOWED_ROLES)) {
            $users = $this->User_model->get_all_users();
            $data = array(
                "users" => $users
            );

            $this->load->view('admin/dashboard/home', $data);
        } else {
            redirect(base_url('admin/access_denied'));
        }
    }

    public function delete_user($ALLOWED_ROLES = array("root", "admin", "moderator"))
    {
        // path("admin/delete_user")
        /* Delete user */
        if ($this->check_role($ALLOWED_ROLES)) {

            $user_id = $this->input->post('userId');  // get post id to delete user
            $query = $this->User_model->delete_user_by_id($user_id);
            if ($query) {
                //$this->session->set_flashdata('success', 'Success Message...');
                //$this->session->set_flashdata('warning', 'Warning Message...');
                $this->session->set_flashdata('info', 'Record was deleted');
                //$this->session->set_flashdata('error', 'Wrong credentials were provided');
                redirect(base_url('admin/dashboard'));
            } else {
                echo "forbidden action";
            }
        }else{
            $this->load->view('layout/head');
            $this->load->view('errors/permission_error');
        }
    }

    public function edit_user($user_id)
    {
        $header_data = array(
            "is_authenticated" => $this->is_authenticated()
        );
        // VALIDATION ?
        $user = $this->User_model->get_user_by_id($user_id);
        $data = array();
        $data['user'] = $user;
        $data['all_roles'] = $this->User_model->role_enums('tb_users', 'role');

        $this->form_validation->set_rules('username', 'Username', 'required');
        if($this->form_validation->run() == false){
            $this->load->view('layout/head');
            $this->load->view('layout/header', $header_data);
            $this->load->view('admin/edit_user', $data);
        }else{
            $form_array = array();
            $form_array['username'] = $this->input->post('username');
            $this->User_model->update_user_by_id($user_id, $form_array);
            redirect(base_url('admin/dashboard'));
        }
    }

    public function access_denied(){
        $this->load->view('layout/head');
        $this->load->view('errors/permission_error');
    }


    public function all()
    {
        // :Service - Return last 10 users

        $query = $this->User_model->get_last_ten_entries();

        foreach ($query as $row) {
            echo $row->id . '. ' . $row->username . ' password: ' . $row->password;
            echo "<br/>";
        }
    }

    public function sessions()
    {
        // :Service - Echo session vars
       echo '<pre>' . print_r($_SESSION, TRUE) . '</pre>';
    }



    public function add_training(){

    }


    public function trainings()
    {
        $data['trainings'] = $this->Admin_model->get_all_trainings();
        $this->load->view('admin/trainings/home', $data);
    }

    public function trainings_partners_list($training_id){
        $data['partners'] = $this->Admin_model->get_partners_of_training($training_id);
        $data['training'] = $this->Admin_model->get_training_by_id($training_id);
        $this->load->view('admin/trainings/partners/home', $data);
    }

    public function delete_partner_by_id_from_training(){
        $partner_id = $this->input->post('partnerId');
        $training_id = $this->input->post('trainingId');
        $query = $this->Admin_model->delete_partner_by_id_from_training($partner_id);
        if ($query) {
            redirect(base_url('admin/trainings_partners_list/' . $training_id));
        } else {
            echo "forbidden action";
        }

    }


}
