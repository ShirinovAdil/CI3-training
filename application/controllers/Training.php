<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Training extends CI_Controller
{


    public function __construct()
    {
        parent::__construct();
        $this->load->model("Training_model"); // load model
    }

    public function index($message = NULL)
    {
        $header_data = array(
            "is_authenticated" => true
        );

        $this->load->view('layout/head');
        $this->load->view('layout/header', $header_data);

        $training = $this->Training_model->get_active_training();

        $data = array(
            "training" => $training
        );

        $this->load->view('trainings/training', $data);
    }


}
