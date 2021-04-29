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
        $this->load->library('upload');
    }


    public function index($message = NULL)
    {
        redirect(base_url('admin/login'));
    }

    public function login()
    {
        if ($this->login_required()) {
            $this->load->view('admin/login');
        } else {
            redirect(base_url('admin/dashboard'));
        }
    }

    public function check_role($role_list)
    {
        // :Service - Check if user has needed role
        // Takes a list and checks if current role is in the list

        $user_role = $this->session->userdata('userRole');
        if (in_array($user_role, $role_list)) {
            return true;
        } else {
            $this->session->sess_destroy();
            redirect(base_url('admin/access_denied'));
        }
    }


    public function is_authenticated()
    {
        // :Service - Check if user is logged in

        $userId = $this->session->userdata('userId');
        $userRole = $this->session->userdata('userRole');
        $username = $this->session->userdata('username');
        if ($userId && $userRole && $username) {
            return true;
        } else {
            $this->session->sess_destroy();
            redirect(base_url('admin/login'));
        }
    }


    public function login_required()
    {
        $userId = $this->session->userdata('userId');
        $userRole = $this->session->userdata('userRole');
        $username = $this->session->userdata('username');
        $is_authenticated = $this->session->userdata('is_authenticated');
        if ($userId && $userRole && $username && $is_authenticated) {
            return false;
        } else {
            $this->session->sess_destroy();
            return true;
        }
    }

    public function isNumeric($arg){
        if (!is_numeric($arg)){
            redirect(base_url('admin/access_denied'));
        }else{
            return true;
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
                    'userRole' => $user->role,
                    'username' => $user->username,
                    'is_authenticated' => true
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

        $this->session->unset_userdata('userId');
        $this->session->unset_userdata('userRole');
        $this->session->unset_userdata('username');
        $this->session->unset_userdata('is_authenticated');

        $this->session->sess_destroy(); // extra check

        redirect(base_url('admin/login'));
    }


    public function dashboard($ALLOWED_ROLES = array("root", "admin", "moderator"))
    {
        // path("admin/dashboard")
        /* Render admin dashboard  */


        $this->is_authenticated();
        $this->check_role($ALLOWED_ROLES);

        $header_data = array(
            "is_authenticated" => true
        );

        $users = $this->User_model->get_all_users();
        $data = array(
            "users" => $users
        );
        $this->load->view('admin/dashboard/home', $data);

    }

    /************ USER **************/
    public function delete_user($ALLOWED_ROLES = array("root", "admin"))
    {
        // path("admin/delete_user")
        /* Delete user */

        $this->is_authenticated();
        $this->check_role($ALLOWED_ROLES);

        $user_id = $this->input->post('userId');  // get post id to delete user
        $this->isNumeric($user_id);

        $query = $this->User_model->delete_user_by_id($user_id);

        if ($query) {
            //$this->session->set_flashdata('success', 'Success Message...');
            //$this->session->set_flashdata('warning', 'Warning Message...');
            //$this->session->set_flashdata('error', 'Wrong credentials were provided');
            $this->session->set_flashdata('info', 'Record was deleted');
            redirect(base_url('admin/dashboard'));
        } else {
            echo "forbidden action";
        }

    }

    public function edit_user($user_id, $ALLOWED_ROLES = array("root", "admin"))
    {
        $this->is_authenticated();
        $this->check_role($ALLOWED_ROLES);

        $header_data = array(
            "is_authenticated" => true
        );

        $this->isNumeric($user_id);

        $user = $this->User_model->get_user_by_id($user_id);
        $data = array();
        $data['user'] = $user;
        $data['all_roles'] = $this->User_model->role_enums('tb_users', 'role');
        $data['header_data'] = $header_data;

        $this->form_validation->set_rules('username', 'Username', 'required');
        if ($this->form_validation->run() == false) {
            $this->load->view('admin/users/edit/home', $data);
        } else {
            $form_array = array();
            $form_array['username'] = $this->input->post('username');
            $this->User_model->update_user_by_id($user_id, $form_array);
            redirect(base_url('admin/dashboard'));
        }
    }
    /************ USER END **************/




    /************ ERRORS ***********/

    public function access_denied()
    {
        $this->load->view('errors/permission/home');
    }

    /************ END ERRORS ***********/




    /*************** EXTRAS ****************/
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

    /*************** END EXTRAS ****************/




    /***************  TRAININGS ****************/

    public function trainings()
    {
        /** List all trainings **/

        $this->is_authenticated();
        $this->check_role($ALLOWED_ROLES = array("root", "admin, moderator"));

        $data['trainings'] = $this->Admin_model->get_all_trainings();
        $this->load->view('admin/trainings/home', $data);
    }


    public function trainings_partners_list($training_id)
    {
        /** List partners of specific training **/

        $this->is_authenticated();
        $this->check_role($ALLOWED_ROLES = array("root", "admin, moderator"));
        $this->isNumeric($training_id);


        $data['partners'] = $this->Admin_model->get_partners_of_training($training_id);
        $data['training'] = $this->Admin_model->get_training_by_id($training_id);
        $this->load->view('admin/trainings/partners/home', $data);
    }

    public function delete_training()
    {
        /** Delete a training **/

        $this->is_authenticated();
        $this->check_role($ALLOWED_ROLES = array("root"));

        $t_id = $this->input->post('t_id');
        $this->isNumeric($t_id);

        $query = $this->Admin_model->delete_training_by_id($t_id);
        if ($query) {
            redirect(base_url('admin/trainings'));
        } else {
            echo "forbidden";
        }

    }

    public function delete_partner_by_id_from_training()
    {
        /** Delete a partner from training by p_id **/
        /** p_id comes from form hidden input on post request **/

        $this->is_authenticated();
        $this->check_role($ALLOWED_ROLES = array("root"));

        $partner_id = $this->input->post('partnerId');
        $training_id = $this->input->post('trainingId');
        $this->isNumeric($partner_id);
        $this->isNumeric($training_id);

        $query = $this->Admin_model->delete_partner_by_id_from_training($partner_id, $training_id);
        if ($query) {
            redirect(base_url('admin/trainings_partners_list/' . $training_id));
        } else {
            echo "forbidden action";
        }

    }

    public function add_partner_to_training($training_id)
    {
        $this->is_authenticated();
        $this->check_role($ALLOWED_ROLES = array("root"));

        $data['training'] = $this->Admin_model->get_training_by_id($training_id);
        $this->isNumeric($training_id);

        $partners_list = $this->Admin_model->get_all_partners_for_dropdown();
        $selected_partners_list = $this->Admin_model->get_partners_of_training($training_id);

        $data["selected_partners_list"] = array();
        foreach ($selected_partners_list as $selected_partner) {
            array_push($data["selected_partners_list"], $selected_partner["p_id"]);
        }

        $data["partners"] = array();
        foreach ($partners_list as $partner) {
            $data["partners"][$partner["p_id"]] = $partner["p_name"];
        }
        $this->load->view('admin/trainings/partners/partners_add/home', $data);

    }

    public function add_partner_to_training_validate($training_id)
    {
        $this->is_authenticated();
        $this->check_role($ALLOWED_ROLES = array("root"));
        $this->isNumeric($training_id);


        $data = $this->input->post('partnerSelect');
        $this->Admin_model->add_partners_to_training($training_id, $data);
        redirect(base_url('admin/trainings'));
    }

    public function edit_training_status($training_id)
    {
        // Toggle training partner status 0n -> Off || Off -> On

        $this->is_authenticated();
        $this->check_role($ALLOWED_ROLES = array("root"));
        $this->isNumeric($training_id);


        $this->Admin_model->change_training_status($training_id);
        redirect(base_url('admin/trainings'));
    }

    /************ END TRIANINGS ************/


    /************ PARTNERS ************/
    public function partners()
    {
        /** List all partners **/

        $this->is_authenticated();
        $this->check_role($ALLOWED_ROLES = array("root"));

        $data['partners'] = $this->Admin_model->get_all_partners();
        $this->load->view('admin/partners/home', $data);
    }

    public function delete_partner()
    {
        /** Delete a partner **/

        $this->is_authenticated();
        $this->check_role($ALLOWED_ROLES = array("root"));

        $partner_id = $this->input->post('partnerId');  // get post id to delete user
        $this->isNumeric($partner_id);

        $query = $this->Admin_model->delete_partner_by_id($partner_id);

        if ($query) {
            redirect(base_url('admin/partners'));
        } else {
            echo "forbidden action";
        }
    }

    public function edit_partner($partner_id)
    {
        $this->is_authenticated();
        $this->check_role($ALLOWED_ROLES = array("root"));
        $this->isNumeric($partner_id);

        $header_data = array(
            "is_authenticated" => true
        );
        $partner = $this->Admin_model->get_partner_by_id($partner_id);
        $data = array();
        $data['partner'] = $partner;
        $data['header_data'] = $header_data;

        $this->form_validation->set_rules('partnerName', 'Partner Name', 'required');
        //$this->form_validation->set_rules('partnerWebsite', 'Partner Website', 'required');

        if ($this->form_validation->run() == false) {
            $this->load->view('admin/partners/edit/home', $data);
        } else {
            $form_array = array();
            $form_array['p_name'] = $this->input->post('partnerName');
            $form_array['p_website'] = $this->input->post('partnerWebsite');
            $this->Admin_model->update_partner_by_id($partner_id, $form_array);
            redirect(base_url('admin/partners'));
        }
    }

    public function add_partner()
    {
        // Add a new partner

        $this->is_authenticated();
        $this->check_role($ALLOWED_ROLES = array("root"));
        $this->load->view('admin/partners/add/home');
    }

    public function add_partner_validate()
    {
        // Service: Validate partner addition

        $this->is_authenticated();
        $this->check_role($ALLOWED_ROLES = array("root"));

        $config['upload_path'] = './uploads/partners';
        $config['allowed_types'] = 'gif|jpg|png';
        $config['max_size'] = 100;
        $config['max_width'] = 1024;
        $config['max_height'] = 768;

        $this->upload->initialize($config);

        $this->form_validation->set_rules('partnerName', 'Partner Name', 'required');
        //$this->form_validation->set_rules('partnerWebsite', 'Partner Website', 'required');


        if ($this->form_validation->run() == false || !$this->upload->do_upload('userfile')) {
            $error = array('error' => $this->upload->display_errors());
            $this->load->view('admin/partners/add/home', $error);
        } else {
            $data = array('upload_data' => $this->upload->data());

            $partner_name = $this->input->post('partnerName');
            $partner_website = $this->input->post('partnerWebsite');
            $partner_image = $data['upload_data']['file_path'] . $data['upload_data']['file_name'];
            $partner_image = str_replace('C:/xampp/htdocs/CI3-training', '.', $partner_image);

            $partner_data = array(
                'p_name' => $partner_name,
                'p_website' => $partner_website,
                'p_image' => $partner_image,
            );
            $this->Admin_model->add_partner($partner_data);
            redirect(base_url('admin/partners'));
        }

    }

    public function edit_partner_status($partner_id)
    {
        // Toggle partner status 0n -> Off || Off -> On

        $this->is_authenticated();
        $this->check_role($ALLOWED_ROLES = array("root"));
        $this->isNumeric($partner_id);


        $this->Admin_model->change_partner_status($partner_id);
        redirect(base_url('admin/partners'));
    }

    public function edit_training_partner_status($training_id, $partner_id)
    {
        // Toggle training partner status 0n -> Off || Off -> On

        $this->is_authenticated();
        $this->check_role($ALLOWED_ROLES = array("root"));
        $this->isNumeric($training_id);
        $this->isNumeric($partner_id);


        $this->Admin_model->change_training_partner_status($training_id, $partner_id);
        redirect(base_url('admin/trainings_partners_list/' . $training_id));
    }

    /************ END PARTNERS ************/


}
