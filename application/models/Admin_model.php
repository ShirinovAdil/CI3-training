<?php

class Admin_model extends CI_Model
{


    function get_all_trainings()
    {
        $this->db->select('trainings.t_id');
        $this->db->select('trainings.t_title_az');
        $this->db->select('trainings.t_title_en');
        $this->db->select('trainings.t_description_az');
        $this->db->select('trainings.t_description_ez');
        $this->db->select('trainings.t_contact');
        $this->db->select('trainings.t_created_by');
        $this->db->select('partners.p_name');
        $this->db->select('partners.p_image');
        $this->db->select('partners.p_website');
        $this->db->from('trainings');
        $this->db->join('trainings_partners', 'trainings_partners.tp_t_id = trainings.t_id');
        $query = $this->db->get();

        return $query->result_array();
    }

}


